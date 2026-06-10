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
}


