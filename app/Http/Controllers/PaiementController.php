<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Devis;

class PaiementController extends Controller
{
   public function checkout(Request $request)
{
    // Vérifier qu'il y a un panier
    if (!session()->has('panier_total')) {
        return redirect()->route('user.dashboard')->with('error', 'Aucun devis en cours.');
    }

    Stripe::setApiKey(config('services.stripe.secret'));

    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => session('panier_service'),
                ],
                'unit_amount' => session('panier_total') * 100, // en centimes
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',

        // 🔥 ICI : on ajoute le session_id dans l’URL de retour
        'success_url' => route('paiement.success') . '?session_id={CHECKOUT_SESSION_ID}',

        'cancel_url' => route('panier.show'),
    ]);

    return redirect($session->url);
}


    public function success(Request $request)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    $sessionId = $request->get('session_id');

    if (!$sessionId) {
        return redirect()->route('user.dashboard')->with('error', 'Session Stripe introuvable.');
    }

    $session = Session::retrieve($sessionId);

    if ($session->payment_status !== 'paid') {
        return redirect()->route('user.dashboard')->with('error', 'Paiement non confirmé.');
    }

    $devisId = $session->metadata->devis_id;

    if ($devisId) {
        $devis = Devis::find($devisId);
        if ($devis) {
            $devis->statut = 'payé';
            $devis->save();
        }
    }

    return redirect()->route('user.dashboard')->with('success', 'Paiement effectué avec succès.');
}

}

