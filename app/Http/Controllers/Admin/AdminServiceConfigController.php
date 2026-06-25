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

 public function store(Request $request, $devis_id)
{
    $devis = \App\Models\Devis::findOrFail($devis_id);

    // Données communes
    $data = [
        'client_name' => $request->client_name,
        'client_email' => $request->client_email,
    ];

    // Données SITE
    if ($devis->service_type === 'site') {
        $data = array_merge($data, [
            'site_name' => $request->site_name,
            'site_login' => $request->site_login,
            'site_password' => $request->site_password,
            'emails' => $request->emails ?? [],
            'github_login' => $request->github_login,
            'github_password' => $request->github_password,
        ]);
    }

    // Données AD
    if ($devis->service_type === 'ad') {
        $data = array_merge($data, [
            'ad_main_login' => $request->ad_main_login,
            'ad_main_password' => $request->ad_main_password,
            'ad_emails' => $request->ad_emails ?? [],
        ]);
    }

    // Enregistrement
    \App\Models\ServiceConfig::updateOrCreate(
        ['devis_id' => $devis_id],
        ['data' => $data]
    );

    return back()->with('success', 'Configuration enregistrée.');
}

}

