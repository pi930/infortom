<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devis;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class AdminDevisController extends Controller
{
    public function create(Request $request)
    {
        $client_name = $request->client_name;
        $client_email = $request->client_email;
        $client_address = $request->client_address;

        // Prestations autorisées pour la page admin
        $adminPrices = [
            'site_internet' => 200,
            'nom_de_domaine' => 6,
            'depannage' => 60,
        ];

       return view('admin.devis.create', compact(
    'client_name',
    'client_email',
    'client_address',
    'adminPrices'
));
    }

    public function store(Request $request)
    {

 $request->validate([
    'client_name'   => 'required|string|max:255',
    'client_email'  => 'required|email|max:255',
    'custom_name'   => 'nullable|string|max:255',
    'custom_amount' => 'nullable|numeric|min:0|max:10000',
    'items'         => 'nullable|array',
    'client_address' => 'required|string|max:1000',
]);   
        // Liste des prix
        $prices = [
            'site_internet' => 200,
            'nom_de_domaine' => 6,
            'depannage' => 60,
            'campagne_pub' => 100,
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
        $total_ttc = $total_ht;

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

        // Déterminer si acompte ou paiement total
        $acompte_possible = $total_ttc > 100;
        $acompte = $acompte_possible ? 100 : 0;
        $reste = $total_ttc - $acompte;

        // Création du devis
        $devis = Devis::create([
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'items' => $selected,
            'total_ht' => $total_ht,
            'tva' => $tva,
            'total_ttc' => $total_ttc,
            'acompte_possible' => $acompte_possible,
            'acompte' => $acompte,
            'reste_a_payer' => $reste,
            'user_id' => $user->id ?? null,
            'service_type' => $service_type,
        ]);

        // Génération du contrat
        $contrat = "
CONTRAT DE VENTE

Client : {$devis->client_name}
Email : {$devis->client_email}

Prestations :
" . implode("\n", $selected) . "

Montant total : {$total_ttc} €

" . ($acompte_possible
            ? "Acompte : 100 €\nReste à payer : {$reste} €"
            : "Paiement total : {$total_ttc} €") . "

Fait à Cannes, le " . date('d/m/Y') . ".
";

        $devis->contrat = $contrat;
        $devis->save();

        // Lien de paiement
        $paymentLink = $acompte_possible
            ? route('paiement.acompte', $devis->id)
            : route('paiement.total', $devis->id);

        // Envoi email SEULEMENT si acompte_possible = true
        if ($acompte_possible) {

            try {

                Mail::send([], [], function ($message) use ($devis, $contrat, $paymentLink) {
                    $message->to($devis->client_email)
                            ->subject("Votre devis Infortom #{$devis->id}")
                            ->text("
Bonjour {$devis->client_name},

Voici votre devis :

Montant total : {$devis->total_ttc} €

Prestations :
" . implode("\n", $devis->items) . "

Contrat :
{$contrat}

Pour payer l'acompte de 100 €, cliquez ici :
{$paymentLink}

Cordialement,
Infortom
06400 Cannes
");
                });

                $devis->email_sent = true;
                $devis->save();

            } catch (\Throwable $e) {

                Log::error('Erreur mail devis #' . $devis->id . ' : ' . $e->getMessage());

                $devis->email_sent = false;
                $devis->save();

                return redirect()->route('admin.devis.index')
                    ->with('error', 'Devis créé, mais l\'email n\'a pas pu être envoyé : ' . $e->getMessage());
            }

        } else {

            // Total <= 100 € : pas d'email envoyé
            $devis->email_sent = false;
            $devis->save();
        }

        return redirect()->route('admin.devis.index')
            ->with('success', 'Devis créé.');
    }

    public function sendResteEmail(Devis $devis)
    {
        if ($devis->paiement_type !== 'acompte') {
            return back()->with('error', 'Le reste n\'est envoyable qu\'après paiement de l\'acompte.');
        }

        $lienReste = route('paiement.reste', $devis->id);
        $reste = $devis->total_ttc - 100;

        try {

            Mail::raw(
                "Bonjour {$devis->client_name},\n\n"
                . "Voici le lien pour régler le solde de votre devis #{$devis->id}.\n\n"
                . "Reste à payer : {$reste} €\n"
                . "Lien : {$lienReste}\n\n"
                . "Cordialement,\nInfortom\n06400 Cannes",
                function ($message) use ($devis) {
                    $message->to($devis->client_email)
                            ->subject("Reste à payer - Devis Infortom #{$devis->id}");
                }
            );

            $devis->reste_email_sent = true;
            $devis->save();

        } catch (\Throwable $e) {

            Log::error('Erreur mail reste devis #' . $devis->id . ' : ' . $e->getMessage());

            return back()->with('error', 'Erreur lors de l\'envoi du mail : ' . $e->getMessage());
        }

        return back()->with('success', 'Email du reste à payer envoyé au client.');
    }

    public function sendEmail(Devis $devis)
    {
        if ($devis->acompte_possible) {
            $paymentLink = route('paiement.acompte', $devis->id);
            $texte = "Acompte à régler : 100 €\n"
                   . "Reste à payer après l'acompte : " . ($devis->total_ttc - 100) . " €\n"
                   . "Lien pour payer l'acompte : {$paymentLink}";
            $sujet = "Acompte - Devis Infortom #{$devis->id}";
        } else {
            $paymentLink = route('paiement.total', $devis->id);
            $texte = "Montant total : {$devis->total_ttc} €\n"
                   . "Lien : {$paymentLink}";
            $sujet = "Paiement - Devis Infortom #{$devis->id}";
        }

        try {

            Mail::raw(
                "Bonjour {$devis->client_name},\n\n"
                . "Voici le lien pour régler votre devis #{$devis->id}.\n\n"
                . $texte . "\n\n"
                . "Cordialement,\nInfortom\n06400 Cannes",
                function ($message) use ($devis, $sujet) {
                    $message->to($devis->client_email)->subject($sujet);
                }
            );

            $devis->email_sent = true;
            $devis->save();

        } catch (\Throwable $e) {

            Log::error('Erreur mail paiement devis #' . $devis->id . ' : ' . $e->getMessage());

            return back()->with('error', 'Erreur lors de l\'envoi du mail : ' . $e->getMessage());
        }

        return back()->with('success', 'Email de paiement envoyé au client.');
    }

    public function show(Devis $devis)
    {
        $contrat = $devis->contrat;

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
        $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|max:255|unique:users,email,' . $user->id,
]);

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

    $request->validate([
        'contrat_pdf' => 'required|file|mimes:pdf|max:10240'
    ]);

    $file = $request->file('contrat_pdf');

       

        // Nettoyage du nom
       $cleanName = preg_replace(
    '/[^A-Za-z0-9._-]/',
    '_',
    $file->getClientOriginalName()
);
        $filename = time() . '_' . $cleanName;

        // Stockage
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
