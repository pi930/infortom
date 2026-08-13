<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devis;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


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

    // Ajout du montant personnalisé
    $custom_name = $request->custom_name;
    $custom_amount = $request->custom_amount;

    if (!empty($custom_amount)) {
        $total_ht += floatval($custom_amount);
        $selected[] = "custom:" . $custom_name . ":" . $custom_amount;
    }

    // TVA supprimée
    $tva = 0;

    // Total TTC = HT
    $total_ttc = $total_ht;

    // Déterminer si acompte possible
    $acompte_possible = $total_ht >= 500;

    // Détection automatique du type de service
    $site_items = ['hebergement', 'email', 'blog'];
    $ad_items = ['active_directory', 'windows_server_2025'];

    if (count(array_intersect($selected, $site_items)) > 0) {
        $service_type = 'site';
    } elseif (count(array_intersect($selected, $ad_items)) > 0) {
        $service_type = 'ad';
    } else {
        $service_type = 'standard';
    }

    // Trouver l'utilisateur correspondant à l'email
    $user = User::where('email', $request->client_email)->first();

    // Création du devis (UNE SEULE FOIS)
    $devis = Devis::create([
        'client_name' => $request->client_name,
        'client_email' => $request->client_email,
        'items' => $selected,
        'total_ht' => $total_ht,
        'tva' => $tva,
        'total_ttc' => $total_ttc,
        'acompte_possible' => $acompte_possible,
        'user_id' => $user->id ?? null,
        'service_type' => $service_type,
    ]);

    // 🔥 CONTRAT GÉNÉRÉ (CHAMPS VIDES POUR REMPLISSAGE)
    $contrat = "
CONTRAT DE VENTE

ENTRE :

Thomas PIERRARD, né le 31/01/1980 à Senlis 60300, France,
micro-entrepreneur immatriculé sous le numéro SIRET : en cours d’attribution,
domicilié 12 impasse Saint-Louis, 06400 Cannes.

Ci-après dénommé le « Vendeur », d'une part,

ET :

Nom : __________________________
Prénom : ________________________
Entreprise : __________________________
Adresse : __________________________
Ville : __________________________
SIRET : __________________________
Date de naissance : __________________________
Ville de naissance : __________________________
Fonction : __________________________

ARTICLE 1 - OBJET DU CONTRAT

Bien(s) vendu(s) :
- [Description du bien sélectionné]
- [Autres prestations cochées]

Nom du Bien :
- [URL du site web] ou SERVEUR AD

ARTICLE 2 - PRIX

Montant total : ".$total_ttc." € — TVA 0%

ARTICLE 3 - CONDITIONS DE PAIEMENT

Facture envoyée par courriel.

Paiement en deux fois :
- 200 € à la signature du contrat
- [Reste à payer] € à la fin du travail

Mode de paiement : carte bancaire.

ARTICLE 4 - LIVRAISON

Livraison dans un délai de [X jours].

Réclamations : 15 jours par courriel concernant :
- [URL du site] ou SERVEUR AD

ARTICLE 9 - LITIGES

Tribunaux compétents : Cannes.

SIGNATURES

POUR LE VENDEUR :
Thomas PIERRARD

POUR L’ACQUÉREUR :
Nom : __________________________
Prénom : ________________________
Signature :

Fait à Cannes, le ".date('d/m/Y').".
";

    // 🔥 Sauvegarde du contrat dans la base
    DB::table('devis')
    ->where('id', $devis->id)
    ->update(['contrat' => $contrat]);


    // 🔥 IMPORTANT : REDIRECTION
    return redirect()->route('admin.devis.show', $devis->id);
}



public function show(Devis $devis)
{
    $contrat = $devis->contrat; // 🔥 On récupère le contrat depuis la base

    return view('admin.devis.show', compact('devis', 'contrat'));
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
public function download($id)
{
    $devis = Devis::findOrFail($id);

    return response($devis->contrat)
        ->header('Content-Type', 'text/plain')
        ->header('Content-Disposition', 'attachment; filename="contrat_devis_'.$id.'.txt"');
}

public function upload(Request $request, $id)
{
    $devis = Devis::findOrFail($id);

    if (!$request->hasFile('contrat_pdf')) {
        return back()->with('error', 'Aucun fichier reçu.');
    }

    $file = $request->file('contrat_pdf');

    // Nettoyage du nom
    $cleanName = str_replace([' ', 'é', 'è', 'ê', 'à'], '_', $file->getClientOriginalName());
    $filename = time() . '_' . $cleanName;

    // Stockage FIABLE
    Storage::disk('public')->putFileAs(
        'contrats_signes',
        $file,
        $filename
    );

    // Mise à jour BDD
    $devis->contrat_signe = 1;
    $devis->contrat_pdf = 'contrats_signes/' . $filename;
    $devis->save();

    return back()->with('success', 'Contrat signé importé avec succès.');
}

public function downloadSigned($id)
{
    $devis = Devis::findOrFail($id);

    return response()->download(
        storage_path('app/public/' . $devis->contrat_pdf)
    );
}
public function downloadBoth($id)
{
    $devis = Devis::findOrFail($id);

    return response()->download(
        storage_path('app/public/' . $devis->contrat_pdf_both)
    );
}





}
