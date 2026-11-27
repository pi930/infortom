<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Devis;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Facture;


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

    try {

      

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


    } catch (\Throwable $e) {


        return back()->with('error', $e->getMessage());
    }

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
    \Log::info('Retour Stripe atteint');

    $sessionId = $request->get('session_id');

    if (!$sessionId) {
        return redirect()->route('home')
            ->with('error', 'Session Stripe introuvable.');
    }

    try {
        Stripe::setApiKey(config('services.stripe.secret'));
        $session = Session::retrieve($sessionId);
    } catch (\Throwable $e) {
        \Log::error('Impossible de récupérer la session Stripe : '.$e->getMessage());

        return redirect()->route('home')
            ->with('error', 'Impossible de vérifier le paiement.');
    }

    if ($session->payment_status !== 'paid') {
        return redirect()->route('home')
            ->with('error', 'Paiement non confirmé.');
    }

    $devisId = $session->metadata->devis_id ?? null;
    $typePaiement = $session->metadata->type_paiement ?? null;
    $devis = $devisId ? Devis::find($devisId) : null;

    if (!$devis || !in_array($typePaiement, ['total', 'acompte', 'reste'], true)) {
        return redirect()->route('home')
            ->with('error', 'Devis ou type de paiement introuvable.');
    }

    $typeFacture = match ($typePaiement) {
        'total' => 'totale',
        'acompte' => 'acompte',
        'reste' => 'solde',
    };

    $montant = match ($typePaiement) {
        'total' => $devis->total_ttc,
        'acompte' => 100,
        'reste' => $devis->total_ttc - 100,
    };

    // Enregistre le paiement seulement s'il ne l'est pas déjà.
    // Même s'il est déjà enregistré, on continue pour réparer/générer la facture.
    if ($devis->paiement_type !== $typePaiement) {
        $devis->statut = $typePaiement === 'acompte' ? 'acompte_payé' : 'payé';
        $devis->paiement_type = $typePaiement;
        $devis->paiement_date = now();
        $devis->save();
    }

    try {
        $facture = $devis->factures()
            ->where('type', $typeFacture)
            ->first();

        $nouvelleFacture = false;

        if (!$facture) {

    $derniereFacture = Facture::latest('id')->first();

    $prochainNumero = $derniereFacture
        ? $derniereFacture->id + 1
        : 1;

    $numero = 'FAC-' . now()->format('Y') . '-' .
        str_pad($prochainNumero, 4, '0', STR_PAD_LEFT);

    $montantFacture = match ($typePaiement) {
        'acompte' => 100,
        'reste'   => $devis->total_ttc - 100,
        default   => $devis->total_ttc,
    };

    $facture = $devis->factures()->create([

        'numero' => $numero,

        'type' => match ($typePaiement) {
            'acompte' => 'acompte',
            'reste'   => 'solde',
            default   => 'totale',
        },

        'montant' => $montantFacture,

        'montant_ht' => $montantFacture,

        'montant_ttc' => $montantFacture,

        'tva' => 0,

        'date_facture' => now(),

        'email_envoye' => false,

        'email_envoye_le' => null,
    ]);

    $nouvelleFacture = true;
}

        $path = "factures/facture_{$typePaiement}_devis_{$devis->id}.pdf";

        if (!$facture->pdf_path || !Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory('factures');

            $pdf = Pdf::loadView("pdf.facture_{$typePaiement}", [
                'devis' => $devis,
                'facture' => $facture,
            ]);

            Storage::disk('public')->put($path, $pdf->output());
            $facture->update(['pdf_path' => $path]);
        }

        // Évite un nouvel envoi automatique quand Stripe recharge la page de retour.
        if ($nouvelleFacture) {
            Mail::send('emails.facture', [
    'devis' => $devis,
    'facture' => $facture,
], function ($message) use ($devis, $path) {

    $message->to($devis->client_email)
        ->subject("Votre facture - Devis #{$devis->id}")
        ->attach(Storage::disk('public')->path($path));

});

$facture->update([
    'email_envoye' => true,
    'email_envoye_le' => now(),
]);

\Log::info('Facture envoyée à : '.$devis->client_email);}
    } catch (\Throwable $e) {
        \Log::error('Erreur lors de la création de la facture : '.$e->getMessage());
        report($e);

        return redirect()->route('home')
            ->with('error', 'Paiement reçu, mais la facture n’a pas pu être générée. Contacte Infortom.');
    }

    return redirect()->route('home')
        ->with('success', 'Paiement effectué avec succès.');
}

    public function cancel()
    {
        return redirect()->route('home')->with('error', 'Paiement annulé.');
    }
}