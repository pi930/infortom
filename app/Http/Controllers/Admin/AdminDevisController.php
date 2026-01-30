<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devis;
use App\Models\User;

class AdminDevisController extends Controller
{
    public function create()
    {
        return view('admin.devis.create');
    }

    public function store(Request $request)
    {
        // Liste des prix
        $prices = [
            'deplacement' => 60,
            'ssd' => 60,
            'carte_son' => 60,
            'carte_reseau' => 60,
            'blog' => 250,
            'entreprise' => 500,
            'commercial' => 1000,
        ];

        // Récupération des éléments cochés
        $selected = $request->items ?? [];

        // Calcul du total
        $total = 0;
        foreach ($selected as $item) {
            if (isset($prices[$item])) {
                $total += $prices[$item];
            }
        }

        // Trouver l'utilisateur correspondant à l'email
        $user = User::where('email', $request->client_email)->first();

        // Création du devis
        $devis = Devis::create([
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'items' => $selected,
            'total_ttc' => $total,
            'user_id' => $user->id ?? null,
        ]);

        return redirect()->route('admin.devis.show', $devis->id);
    }

    public function show(Devis $devis)
    {
        return view('admin.devis.show', compact('devis'));
    }
}
