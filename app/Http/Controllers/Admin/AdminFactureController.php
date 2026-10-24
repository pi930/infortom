<?php

namespace App\Http\Controllers\Admin;

use App\Models\Devis;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $type = $devis->paiement_type;
        $filename = "facture_{$type}_devis_{$devis->id}.pdf";
        $path = "factures/{$filename}";

        if ($force || !Storage::disk('public')->exists($path)) {
            $pdf = Pdf::loadView($this->viewFor($type), compact('devis'));
            Storage::disk('public')->makeDirectory('factures');
            Storage::disk('public')->put($path, $pdf->output());
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

        Mail::send('emails.facture', ['devis' => $devis], function ($message) use ($devis, $path) {
            $message->to($devis->client_email)
                    ->subject("Votre facture - Devis #{$devis->id}")
                    ->attach(Storage::disk('public')->path($path));
        });

        return back()->with('success', 'Facture envoyée au client.');
    }
}
