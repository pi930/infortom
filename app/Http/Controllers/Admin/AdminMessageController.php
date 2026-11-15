<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ReponseMessageMail;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\RendezVous;

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
    public function destroy($id)
{
    $message = Message::findOrFail($id);
    $message->delete();

    return redirect()
        ->route('admin.messages.index')
        ->with('success', 'Message supprimé avec succès.');
}
public function destroyAuthor($id)
{
    $message = Message::findOrFail($id);
    $email = $message->email;

    $user = User::where('email', $email)->first();

    // Sécurités : ni son propre compte, ni un admin
    if ($user && ($user->id === auth()->id() || $user->role === 'admin')) {
        return redirect()
            ->route('admin.messages.index')
            ->with('error', 'Impossible de supprimer ce compte (administrateur).');
    }

    $count = Message::where('email', $email)->delete();

    if ($user) {
        // Détache les rendez-vous de l'utilisateur (on les conserve)
        RendezVous::where('user_id', $user->id)->update(['user_id' => null]);

        $user->delete();
        $info = "Compte et {$count} message(s) de {$email} supprimés.";
    } else {
        $info = "{$count} message(s) de {$email} supprimés (aucun compte associé).";
    }

    return redirect()
        ->route('admin.messages.index')
        ->with('success', $info);
}
}


