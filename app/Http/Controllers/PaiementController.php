<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Devis;

class PaiementController extends Controller
{
   public function checkoutTotal(Devis $devis)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => "Paiement total du devis #{$devis->id}",
                ],
                'unit_amount' => $devis->total_ttc * 100,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('paiement.success'),
        'cancel_url' => route('user.dashboard'),
        'metadata' => [
    'devis_id' => $devis->id,
    'type_paiement' => 'total', // ou 'acompte' ou 'reste'
],

        ]);

    session(['devis_id' => $devis->id, 'paiement_type' => 'total']);

    return redirect($session->url);
}

public function checkoutAcompte(Devis $devis)
{
    if (!$devis->acompte_possible) {
        return back()->with('error', 'Acompte non disponible pour ce devis.');
    }

    Stripe::setApiKey(config('services.stripe.secret'));

    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => "Acompte sur devis #{$devis->id}",
                ],
                'unit_amount' => 20000, // 200 €
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('paiement.success'),
        'cancel_url' => route('user.dashboard'),
        'metadata' => [
    'devis_id' => $devis->id,
    'type_paiement' => 'acompte',
],


        ]);

    session(['devis_id' => $devis->id, 'paiement_type' => 'acompte']);

    return redirect($session->url);
}

public function checkoutReste(Devis $devis)
{
    if ($devis->paiement_type !== 'acompte') {
        return back()->with('error', 'Le reste n’est payable qu’après acompte.');
    }

    $reste = ($devis->total_ttc - 200) * 100;

    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => "Reste à payer du devis #{$devis->id}",
                ],
                'unit_amount' => $reste,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('paiement.success'),
        'cancel_url' => route('paiement.cancel'),
        'metadata' => [
    'devis_id' => $devis->id,
    'type_paiement' => 'reste',
],

        ]);

    // 🔥 IMPORTANT : enregistrer le paiement du reste
    session([
        'devis_id' => $devis->id,
        'paiement_type' => 'reste'
    ]);

    return redirect($session->url);
}



    public function success()
{
    $devisId = session('devis_id');

    if ($devisId) {
        $devis = Devis::find($devisId);

        if ($devis) {
            $devis->statut = 'payé';
            $devis->paiement_type = session('paiement_type'); // total | acompte
            $devis->paiement_date = now();
            $devis->save();
        }
    }

    session()->forget([
        'panier_service',
        'panier_date',
        'panier_heure',
        'panier_total',
        'devis_id',
        'paiement_type',
    ]);

    return redirect()->route('user.dashboard')->with('success', 'Paiement effectué avec succès.');
}
}

