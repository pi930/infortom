<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Devis;

class AdminPaiementController extends Controller
{
    public function index()
    {
        $paiements = Devis::whereNotNull('paiement_date')
            ->orderBy('paiement_date', 'desc')
            ->get();

        return view('admin.paiements.index', compact('paiements'));
    }
}

