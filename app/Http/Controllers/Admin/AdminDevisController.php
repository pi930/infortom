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
        'active_directory' => 1000,
        'windows_server_2025' => 1200,
        'hebergement' => 20,
        'email' => 5,
    ];

    // Récupération des éléments cochés
    $selected = $request->items ?? [];

    // Calcul du total HT
    $total_ht = 0;
    foreach ($selected as $item) {
        if (isset($prices[$item])) {
            $total_ht += $prices[$item];
        }
    }

    // TVA supprimée
    $tva = 0;

    // Total TTC = HT
    $total_ttc = $total_ht;

    // Déterminer si acompte possible
    $acompte_possible = $total_ht > 500;

    // Détection automatique du type de service
   // Détection automatique du type de service
// Détection automatique du type de service
$service_type = null;

// Services SITE
$site_items = ['hebergement', 'email', 'blog'];

// Services Active Directory
$ad_items = ['active_directory', 'windows_server_2025'];

// Si un item SITE est présent → service = site
if (count(array_intersect($selected, $site_items)) > 0) {
    $service_type = 'site';
}

// Si un item AD est présent → service = ad (prioritaire)
if (count(array_intersect($selected, $ad_items)) > 0) {
    $service_type = 'ad';
}

// Si aucun service détecté → service standard
if (!$service_type) {
    $service_type = 'standard';
}


    // Trouver l'utilisateur correspondant à l'email
    $user = User::where('email', $request->client_email)->first();

    // Création du devis
    $devis = Devis::create([
        'client_name' => $request->client_name,
        'client_email' => $request->client_email,
        'items' => $selected,
        'total_ht' => $total_ht,
        'tva' => $tva,
        'total_ttc' => $total_ttc,
        'acompte_possible' => $acompte_possible,
        'user_id' => $user->id ?? null,
        'service_type' => $service_type, // ← IMPORTANT
    ]);

    return redirect()->route('admin.devis.show', $devis->id);
}


    public function show(Devis $devis)
    {
        return view('admin.devis.show', compact('devis'));
    }
     public function index()
{
    $devis = Devis::orderBy('created_at', 'desc')->get();
    return view('admin.devis.index', compact('devis'));
}


    public function settings()
    {
        return view('admin.users.settings');
    }

    public function updateSettings(Request $request)
    {
        $user = auth()->user();

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Paramètres mis à jour.');
    }
    public function destroy($id)
{
    Devis::findOrFail($id)->delete();
    return back()->with('success', 'Devis supprimé.');
}

}
