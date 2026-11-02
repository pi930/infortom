<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Devis;
use Barryvdh\DomPDF\Facade\Pdf;

class PaiementController extends Controller
{
    public function checkoutTotal(Devis $devis)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // Conversion du total TTC en centimes
        $montant = (int) round($devis->total_ttc * 100);

        $session = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => "Paiement total du devis #{$devis->id}",
                    ],
                    'unit_amount' => $montant,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'payment_method_options' => [
                'card' => [
                    'request_three_d_secure' => 'automatic',
                ],
            ],
            'success_url' => route('paiement.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('home'),
            'metadata' => [
                'site' => 'infortom',
                'devis_id' => $devis->id,
                'type_paiement' => 'total',
            ],
        ]);

        return redirect($session->url);
    }

    public function checkoutAcompte(Devis $devis)
    {
        if (!$devis->acompte_possible) {
            return back()->with('error', 'Acompte non disponible pour ce devis.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        // 100 € d'acompte = 10000 centimes
        $montant = 10000; 

        $session = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => "Acompte sur devis #{$devis->id}",
                    ],
                    'unit_amount' => $montant,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'success_url' => route('paiement.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('home'),
            'metadata' => [
                'site' => 'infortom',
                'devis_id' => $devis->id,
                'type_paiement' => 'acompte',
            ],
        ]);

        return redirect($session->url);
    }

    public function checkoutReste(Devis $devis)
    {
        if ($devis->paiement_type !== 'acompte') {
            return back()->with('error', 'Le reste n’est payable qu’après acompte.');
        }

        // Calcul du reste à payer en euros (Total TTC - 100 € d'acompte)
        $reste = $devis->total_ttc - 100;

        // Conversion en centimes pour Stripe
        $montant = (int) round($reste * 100);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                       'name' => "Reste à payer du devis #{$devis->id}",
                    ],
                    'unit_amount' => $montant,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'success_url' => route('paiement.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('paiement.cancel'),
            'metadata' => [
                'site' => 'infortom',
                'devis_id' => $devis->id,
                'type_paiement' => 'reste',
            ],
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('home')->with('error', 'Session Stripe introuvable.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::retrieve($sessionId);

        if ($session->payment_status !== 'paid') {
            return redirect()->route('home')->with('error', 'Paiement non confirmé.');
        }

        $devisId = $session->metadata->devis_id ?? null;
        $typePaiement = $session->metadata->type_paiement ?? null;
        $devis = $devisId ? Devis::find($devisId) : null;

        if (!$devis || !in_array($typePaiement, ['total', 'acompte', 'reste'])) {
            return redirect()->route('home')->with('error', 'Devis introuvable.');
        }

        if ($devis->paiement_type === $typePaiement) {
            return redirect()->route('home')->with('success', 'Paiement déjà enregistré.');
        }

        $devis->statut = $typePaiement === 'acompte' ? 'acompte_payé' : 'payé';
        $devis->paiement_type = $typePaiement;
        $devis->paiement_date = now();
        $devis->save();

        try {
            $filename = "facture_{$typePaiement}_devis_{$devis->id}.pdf";
            $path = "factures/{$filename}";

            Storage::disk('public')->makeDirectory('factures');
            $pdf = Pdf::loadView("pdf.facture_{$typePaiement}", compact('devis'));
            Storage::disk('public')->put($path, $pdf->output());

            Mail::send('emails.facture', ['devis' => $devis], function ($message) use ($devis, $path) {
                $message->to($devis->client_email)
                        ->subject("Votre facture - Devis #{$devis->id}")
                        ->attach(Storage::disk('public')->path($path));
            });
        } catch (\Throwable $e) {
            report($e);
        }

        return redirect()->route('home')->with('success', 'Paiement effectué avec succès.');
    }

    public function cancel()
    {
        return redirect()->route('home')->with('error', 'Paiement annulé.');
    }
}