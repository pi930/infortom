<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Devis;

class PaiementController extends Controller
{
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

        // Récupération du devis via metadata Stripe
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

