<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    /**
     * Liste des utilisateurs
     */
    public function index()
    {
        $users = User::with('coordonnee')->orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Page paramètres du compte admin
     */
    public function settings()
    {
        return view('admin.users.settings');
    }

    /**
     * Mise à jour des paramètres admin
     */
    public function updateSettings(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Paramètres mis à jour.');
    }
    public function show(User $user)
{
    $coordonnees = $user->coordonnee;
    $messages = $user->messages ?? collect();
    $rendezvous = $user->rendezvous ?? collect();
    $devis = $user->devis ?? collect();

    $serviceConfig = null;
    if ($devis->count() > 0) {
        $serviceConfig = \App\Models\ServiceConfig::whereIn('devis_id', $devis->pluck('id'))->first();
    }

    return view('admin.users.show', compact(
        'user',
        'coordonnees',
        'messages',
        'rendezvous',
        'devis',
        'serviceConfig'
    ));
}



}


