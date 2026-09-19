<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devis;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;



class AdminDevisController extends Controller
{
   public function create(Request $request)
{
    $client_name = $request->client_name;
    $client_email = $request->client_email;

    // Prestations autorisées pour la page admin
    $adminPrices = [
        'site_internet' => 200,
        'nom_de_domaine' => 6,
        'depannage' => 60,
    ];

    return view('admin.devis.create', compact('client_name', 'client_email', 'adminPrices'));
}


public function store(Request $request)
{
    // Liste des prix
   $prices = [
    'site_internet' => 200,
    'nom_de_domaine' => 6,
    'depannage' => 60,
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

    $acompte_possible = $total_ht >= 100;


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
        'service_type' => $service_type,
    ]);

    // 🔥 Génération du contrat
    $contrat = "
CONTRAT DE VENTE

Client : {$devis->client_name}
Email : {$devis->client_email}

Prestations :
" . implode("\n", $selected) . "

Montant total : {$total_ttc} €

Acompte : 100 €
Reste à payer : " . ($total_ttc - 100) . " €


Fait à Cannes, le " . date('d/m/Y') . ".
";

    // Sauvegarde du contrat
    $devis->contrat = $contrat;
    $devis->save();

    // 🔥 Lien de paiement Stripe
    $acompteLink = route('paiement.acompte', $devis->id);

    // 🔥 Envoi du devis par email
    Mail::send([], [], function ($message) use ($devis, $contrat, $acompteLink) {
        $message->to($devis->client_email)
                ->subject("Votre devis Infortom #{$devis->id}")
                ->text("
Bonjour {$devis->client_name},

Voici votre devis :

Montant total : {$devis->total_ttc} €

Prestations :
" . implode("\n", $devis->items) . "

Contrat :
$contrat

Pour payer l'acompte de 100 €, cliquez ici :
$acompteLink

Cordialement,
Infortom
06400 Cannes
");});
$devis->email_sent = true;
$devis->save();


    return redirect()->route('admin.devis.index')
    ->with('success', 'Devis créé et envoyé au client.');

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
