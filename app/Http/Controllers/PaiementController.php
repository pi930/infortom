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
    'line_items' => [[
        'price_data' => [
            'currency' => 'eur',
            'product_data' => [
    'name' => "Paiement total du devis #{$devis->id}",
    'tax_code' => 'txcd_10000000',


            ],
            'unit_amount' => $devis->total_ttc * 100,
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => route('paiement.success') . '?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => route('user.dashboard'),
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

        $session = Session::create([
    'line_items' => [[
        'price_data' => [
            'currency' => 'eur',
            'product_data' => [
                'name' => "Acompte sur devis #{$devis->id}",
                'tax_code' => 'txcd_10000000',
            ],
            'unit_amount' => 20000,
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => route('paiement.success') . '?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => route('user.dashboard'),
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

        $reste = ($devis->total_ttc - 200) * 100;

        Stripe::setApiKey(config('services.stripe.secret'));

       $session = Session::create([
    'line_items' => [[
        'price_data' => [
            'currency' => 'eur',
            'product_data' => [
                'name' => "Reste à payer du devis #{$devis->id}",
                'tax_code' => 'txcd_10000000',
            ],
            'unit_amount' => $reste,
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
]);



        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('user.dashboard')->with('error', 'Session Stripe introuvable.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::retrieve($sessionId);
        $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

        if ($paymentIntent->status !== 'succeeded') {
            return redirect()->route('user.dashboard')->with('error', 'Paiement non confirmé.');
        }

        $devisId = $session->metadata->devis_id ?? null;
        $typePaiement = $session->metadata->type_paiement ?? null;

        if (!$devisId) {
            return redirect()->route('user.dashboard')->with('error', 'Devis introuvable.');
        }

        $devis = Devis::find($devisId);

        if (!$devis) {
            return redirect()->route('user.dashboard')->with('error', 'Devis introuvable.');
        }

        $devis->statut = 'payé';
        $devis->paiement_type = $typePaiement;
        $devis->paiement_date = now();
        $devis->save();

        return redirect()->route('user.dashboard')->with('success', 'Paiement effectué avec succès.');
    }
}

