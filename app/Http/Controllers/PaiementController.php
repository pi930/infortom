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
            'success_url' => route('paiement.success'),
            'cancel_url' => route('panier.show'),
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        // Récupérer le devis lié au panier
        $devisId = session('devis_id');

        if ($devisId) {
            $devis = Devis::find($devisId);
            if ($devis) {
                $devis->statut = 'payé';
                $devis->save();
            }
        }

        // Vider le panier
        session()->forget([
            'panier_service',
            'panier_date',
            'panier_heure',
            'panier_total',
            'devis_id',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Paiement effectué avec succès.');
    }
}

