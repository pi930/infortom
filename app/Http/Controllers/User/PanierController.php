<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devis;
use App\Models\RendezVous;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PanierController extends Controller
{
    public function show()
    {
        return view('panier.show', [
            'service' => session('panier_service'),
            'date'    => session('panier_date'),
            'heure'   => session('panier_heure'),
            'total'   => session('panier_total'),
        ]);
    }

    public function fromDevis(Devis $devis)
    {
        if ($devis->user_id !== auth()->id()) {
            return redirect()->route('user.dashboard')->with('error', 'Ce devis ne vous appartient pas.');
        }

        $rdv = RendezVous::where('user_id', auth()->id())->first();

        session([
            'panier_service' => implode(', ', $devis->items),
            'panier_total'   => $devis->total_ttc,
            'panier_date'    => $rdv?->date,
            'panier_heure'   => $rdv?->heure,
            'devis_id'       => $devis->id,
        ]);

        return redirect()->route('panier.show');
    }

    public function checkout(Request $request)
    {
        if (!session()->has('panier_total')) {
            return redirect()->route('user.dashboard')->with('error', 'Aucun devis en cours.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        // Price IDs dans Render
        $stripeProducts = [
            'blog'        => env('STRIPE_PRICE_BLOG'),
            'entreprise'  => env('STRIPE_PRICE_ENTREPRISE'),
            'commercial'  => env('STRIPE_PRICE_COMMERCIAL'),
            'deplacement' => env('STRIPE_PRICE_DEPLACEMENT'),
        ];

        $service = session('panier_service');
        $serviceKey = explode(', ', $service)[0];

        if (!isset($stripeProducts[$serviceKey])) {
            return redirect()->route('panier.show')->with('error', 'Produit Stripe introuvable.');
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => $stripeProducts[$serviceKey],
                'quantity' => 1,
            ]],
            'mode' => 'payment',

            // Stripe renvoie session_id
            'success_url' => route('paiement.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('panier.show'),

            // Métadonnées Stripe → FINI les sessions Laravel
            'metadata' => [
                'devis_id' => session('devis_id'),
            ],
        ]);

        return redirect($session->url);
    }
}

}



