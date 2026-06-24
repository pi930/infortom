<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Devis;


class AdminServiceConfigController extends Controller
{
    public function form(Devis $devis)
{
    $service = $devis->service_type;

    // Charger la config existante si elle existe
    $config = ServiceConfig::where('devis_id', $devis->id)->first();

    return view('admin.service.config', compact('devis', 'service', 'config'));
}

public function store(Request $request, Devis $devis)

    {
        $data = $request->validate([
    'client_name' => 'required|string',
    'client_email' => 'required|email',

    'site_name' => 'nullable|string',
    'site_login' => 'nullable|string',
    'site_password' => 'nullable|string',
    'emails' => 'nullable|array',
    'emails.*' => 'nullable|email',

    'github_login' => 'nullable|string',
    'github_password' => 'nullable|string',

    'ad_main_login' => 'nullable|string',
    'ad_main_password' => 'nullable|string',

    'ad_emails' => 'nullable|array',
    'ad_emails.*' => 'nullable|email',
]);


        ServiceConfig::create([
        'devis_id' => $devis->id,
        'data' => $data
    ]);

        Mail::to($data['client_email'])
    ->send(new \App\Mail\ServiceConfigMail($devis, $data));

        return redirect()
            ->route('admin.paiements.index')
            ->with('success', 'Configuration envoyée au client.');
    }
}

