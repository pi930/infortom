<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class AdminMessageController extends Controller
{
    // Affichage du tableau de bord admin avec les messages
    public function index()
    {
        $messages = Message::latest()->get();
        return view('admin.dashboard', compact('messages'));
    }

    // Formulaire pour répondre à un message
    public function repondre($id)
    {
        $message = Message::findOrFail($id);
        return view('admin.messages.repondre', compact('message'));
    }

    // Envoi de la réponse
    public function envoyerReponse(Request $request, $id)
    {
        $request->validate([
            'reponse' => 'required|string'
        ]);

        $message = Message::findOrFail($id);

        // Enregistrer la réponse
        $message->reponse = $request->reponse;
        $message->save();

        return redirect()->route('admin.dashboard')->with('success', 'Réponse envoyée');
    }
}


