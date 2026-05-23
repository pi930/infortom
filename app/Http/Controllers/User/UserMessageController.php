<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;

class UserMessageController extends Controller
{
    public function index()
    {
        $messages = auth()->user()->messages;
        return view('user.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        abort_if($message->user_id !== auth()->id(), 403);

        return view('user.messages.show', compact('message'));
    }
    public function reply(Request $request, $id)
{
    $request->validate([
        'reply' => 'required|string|max:2000'
    ]);

    $message = Message::findOrFail($id);

    // Sécurité : l'utilisateur ne peut répondre qu'à ses propres messages
    if ($message->user_id !== auth()->id()) {
        abort(403);
    }

    // On stocke la réponse utilisateur
    $message->user_reply = $request->reply;
    $message->save();

    return back()->with('success', 'Votre réponse a été envoyée.');
}

}

