<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ReponseMessageMail;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminMessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function repondre($id)
    {
        $message = Message::findOrFail($id);
        return view('admin.messages.repondre', compact('message'));
    }

    public function envoyerReponse(Request $request, $id)
    {
        $request->validate([
            'reponse' => 'required|string',
        ]);

        $message = Message::findOrFail($id);

        // Envoi du mail au client
        Mail::to($message->email)->send(
            new ReponseMessageMail($message, $request->reponse)
        );

        // Sauvegarde de la réponse (après l'envoi, pour ne rien enregistrer si le mail échoue)
        $message->reponse = $request->reponse;
        $message->repondu_at = now();
        $message->save();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Réponse envoyée à ' . $message->email);
    }
}


