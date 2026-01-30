<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devis;
use App\Models\RendezVous;

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
        // Vérifier que le devis appartient bien à l'utilisateur
        if ($devis->user_id !== auth()->id()) {
            return redirect()->route('user.dashboard')->with('error', 'Ce devis ne vous appartient pas.');
        }

        // Récupérer le rendez-vous de l'utilisateur
        $rdv = RendezVous::where('user_id', auth()->id())->first();

        // Remplir le panier
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

    // Mapping service → price_id Stripe
    $stripeProducts = [
        'blog'        => 'price_1SuuaGCYZgiwB9PQfSslYb5R',
        'entreprise'  => 'price_1SuuSOCYZgiwB9PQZVqimAt0',
        'commercial'  => 'price_1SuuUJCYZgiwB9PQlSUwa7mH',
        'deplacement' => 'price_1SuuiPCYZgiwB9PQ99m2TEfp',
    ];

    // Récupérer le premier service du devis
    $service = session('panier_service');
    $serviceKey = explode(', ', $service)[0]; // si plusieurs services

    // Vérifier que le service existe dans Stripe
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
        'success_url' => route('paiement.success'),
        'cancel_url' => route('panier.show'),
    ]);

    return redirect($session->url);
}

}



