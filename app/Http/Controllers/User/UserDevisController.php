<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devis;
use Illuminate\Support\Facades\Storage;


class UserDevisController extends Controller
{
    public function show(Devis $devis)
{
    abort_if($devis->user_id !== auth()->id(), 403);

    $contratVisible = $devis->contrat_signe;

    // 🔥 Récupération du contrat depuis la base
    $contrat = $devis->contrat;

    return view('user.devis.show', compact('devis', 'contratVisible', 'contrat'));
}
public function index()
{
    $devis = auth()->user()->devis()->orderBy('created_at', 'desc')->get();

    return view('user.devis.index', compact('devis'));
}
public function download($id)
{
    $devis = Devis::findOrFail($id);
    abort_if($devis->user_id !== auth()->id(), 403);

    return response($devis->contrat)
        ->header('Content-Type', 'text/plain')
        ->header('Content-Disposition', 'attachment; filename="contrat_devis_'.$id.'.txt"');
}




public function downloadSigned($id)
{
    $devis = Devis::findOrFail($id);

    abort_if($devis->user_id !== auth()->id(), 403);

    return response()->download(
        storage_path('app/public/' . $devis->contrat_pdf)
    );
}
public function uploadBoth(Request $request, $id)
{
    $devis = Devis::findOrFail($id);
    abort_if($devis->user_id !== auth()->id(), 403);

    if (!$request->hasFile('contrat_pdf_both')) {
        return back()->with('error', 'Aucun fichier reçu.');
    }

    $file = $request->file('contrat_pdf_both');
    $filename = time() . '_both_' . $file->getClientOriginalName();

    Storage::disk('public')->putFileAs(
        'contrats_signes_both',
        $file,
        $filename
    );

    $devis->contrat_pdf_both = 'contrats_signes_both/' . $filename;
    $devis->save();

    return back()->with('success', 'Contrat signé des deux parties importé.');
}
public function downloadBoth($id)
{
    $devis = Devis::findOrFail($id);
    abort_if($devis->user_id !== auth()->id(), 403);

    return response()->download(
        storage_path('app/public/' . $devis->contrat_pdf_both)
    );
}




}


