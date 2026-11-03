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
private function pmcOptions(): array
{
    $pmc = config('services.stripe.payment_method_configuration');

    return $pmc ? ['payment_method_configuration' => $pmc] : [];
}

public function checkoutTotal(Devis $devis)
{
    Stripe::setApiKey(config('services.stripe.secret'));

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
        'success_url' => route('paiement.success') . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('home'),
        'metadata' => [
            'site' => 'infortom',
            'devis_id' => $devis->id,
            'type_paiement' => 'total',
        ],
    ] + $this->pmcOptions());

    return redirect($session->url);
}

public function checkoutAcompte(Devis $devis)
{
    if (!$devis->acompte_possible) {
        return back()->with('error', 'Acompte non disponible pour ce devis.');
    }

    Stripe::setApiKey(config('services.stripe.secret'));

    $session = Session::create([
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => "Acompte sur devis #{$devis->id}",
                ],
                'unit_amount' => 10000, // 100 €
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('paiement.success') . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('home'),
        'metadata' => [
            'site' => 'infortom',
            'devis_id' => $devis->id,
            'type_paiement' => 'acompte',
        ],
    ] + $this->pmcOptions());

    return redirect($session->url);
}

public function checkoutReste(Devis $devis)
{
    if ($devis->paiement_type !== 'acompte') {
        return back()->with('error', 'Le reste n’est payable qu’après acompte.');
    }

    $montant = (int) round(($devis->total_ttc - 100) * 100);

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
        'success_url' => route('paiement.success') . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('paiement.cancel'),
        'metadata' => [
            'site' => 'infortom',
            'devis_id' => $devis->id,
            'type_paiement' => 'reste',
        ],
    ] + $this->pmcOptions());

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

        // Anti-doublon : si la page est rechargée, on ne retraite pas le paiement
        if ($devis->paiement_type === $typePaiement) {
            return redirect()->route('home')->with('success', 'Paiement déjà enregistré.');
        }

        // "payé" uniquement si tout est réglé
        $devis->statut = $typePaiement === 'acompte' ? 'acompte_payé' : 'payé';
        $devis->paiement_type = $typePaiement;
        $devis->paiement_date = now();
        $devis->save();

        // Facture générée au paiement (une par type, l'acompte est conservé)
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
            report($e); // le paiement reste valide même si le PDF ou le mail échoue
        }

        return redirect()->route('home')->with('success', 'Paiement effectué avec succès.');
    }

    public function cancel()
    {
        return redirect()->route('home')->with('error', 'Paiement annulé.');
    }
}