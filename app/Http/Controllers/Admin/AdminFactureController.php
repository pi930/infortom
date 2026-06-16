<?php

namespace App\Http\Controllers\Admin;

use App\Models\Devis;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminFactureController extends Controller
{
    public function show(Devis $devis)
    {
        $type = $devis->paiement_type;

        $view = match ($type) {
            'total'   => 'pdf.facture_total',
            'acompte' => 'pdf.facture_acompte',
            'reste'   => 'pdf.facture_reste',
            default   => abort(404),
        };

        // Génération PDF
        $pdf = Pdf::loadView($view, compact('devis'));

        $filename = "facture_{$type}_devis_{$devis->id}.pdf";

        // Création du dossier si inexistant
        Storage::disk('public')->makeDirectory('factures');

        // Stockage du PDF dans le bon disque
        Storage::disk('public')->put("factures/{$filename}", $pdf->output());

        // Envoi email
        Mail::send('emails.facture', ['devis' => $devis], function ($message) use ($devis, $filename) {
            $message->to($devis->client_email)
                    ->subject("Votre facture - Devis #{$devis->id}")
                    ->attach(storage_path("app/public/factures/{$filename}"));
        });

        return $pdf->stream($filename);
    }

    public function download(Devis $devis)
    {
        $type = $devis->paiement_type;
        $filename = "facture_{$type}_devis_{$devis->id}.pdf";

        $path = storage_path("app/public/factures/{$filename}");

        if (!file_exists($path)) {
            return back()->with('error', 'La facture n’existe pas encore.');
        }

        return response()->download($path);
    }
}
