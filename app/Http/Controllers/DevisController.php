<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devis;

class DevisController extends Controller
{
    public function accepter()
    {
        // Vérifier qu'il y a bien un panier
        if (!session()->has('panier_total')) {
            return redirect()->route('user.dashboard')->with('error', 'Aucun devis en cours.');
        }

        // Enregistrer le devis
        $devis = Devis::create([
            'user_id'      => auth()->id(),
            'client_name'  => auth()->user()->name,
            'client_email' => auth()->user()->email,
            'items'        => [ session('panier_service') ],
            'total_ttc'    => session('panier_total'),
            'date'         => session('panier_date'),
            'heure'        => session('panier_heure'),
            'statut'       => 'accepté',
        ]);

        // Vider le panier
        session()->forget([
            'panier_service',
            'panier_date',
            'panier_heure',
            'panier_total'
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Devis accepté avec succès.');

}
}

