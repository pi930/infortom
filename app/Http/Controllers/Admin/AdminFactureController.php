<?php

namespace App\Http\Controllers\Admin;

use App\Models\Devis;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Facture;

class AdminFactureController extends Controller
{
    private function viewFor(?string $type): string
    {
        return match ($type) {
            'total'   => 'pdf.facture_total',
            'acompte' => 'pdf.facture_acompte',
            'reste'   => 'pdf.facture_reste',
            default   => abort(404),
        };
    }

    // Génère le PDF si besoin et retourne son chemin relatif sur le disque public
    private function ensurePdf(Devis $devis, bool $force = false): string
{
    $paiementType = $devis->paiement_type;

    $typeFacture = match ($paiementType) {
        'total' => 'totale',
        'acompte' => 'acompte',
        'reste' => 'solde',
        default => abort(404, 'Type de paiement inconnu.'),
    };

    $montant = match ($paiementType) {
        'total' => $devis->total_ttc,
        'acompte' => 100,
        'reste' => $devis->total_ttc - 100,
    };

    $facture = $devis->factures()
        ->where('type', $typeFacture)
        ->first();

    if (!$facture) {
        $numero = 'FAC-' . now()->format('Y') . '-' .
            str_pad((string) (Facture::count() + 1), 4, '0', STR_PAD_LEFT);

        $facture = $devis->factures()->create([
            'numero' => $numero,
            'type' => $typeFacture,
            'montant' => $montant,
            'date_facture' => $devis->paiement_date ?? now(),
        ]);
    }

    $path = "factures/facture_{$paiementType}_devis_{$devis->id}.pdf";

    if ($force || !Storage::disk('public')->exists($path)) {
        $pdf = Pdf::loadView($this->viewFor($paiementType), [
            'devis' => $devis,
            'facture' => $facture,
        ]);

        Storage::disk('public')->makeDirectory('factures');
        Storage::disk('public')->put($path, $pdf->output());

        $facture->update(['pdf_path' => $path]);
    }

    return $path;
}

    // Voir la facture (sans envoyer de mail)
    public function show(Devis $devis)
    {
        $path = $this->ensurePdf($devis, true);

        return response()->file(Storage::disk('public')->path($path));
    }

    // Télécharger (génère automatiquement si absente)
    public function download(Devis $devis)
    {
        $path = $this->ensurePdf($devis);

        return Storage::disk('public')->download($path);
    }

    // Envoi explicite de la facture au client
 public function send(Devis $devis)
{
    $path = $this->ensurePdf($devis);

    $typeFacture = match ($devis->paiement_type) {
        'total' => 'totale',
        'acompte' => 'acompte',
        'reste' => 'solde',
        default => abort(404, 'Type de paiement inconnu.'),
    };

    $facture = $devis->factures()
        ->where('type', $typeFacture)
        ->firstOrFail();

    Mail::send('emails.facture', [
        'devis' => $devis,
        'facture' => $facture,
    ], function ($message) use ($devis, $path) {
        $message->to($devis->client_email)
            ->subject("Votre facture - Devis #{$devis->id}")
            ->attach(Storage::disk('public')->path($path));
    });

    return back()->with('success', 'Facture envoyée au client.');
}
}
