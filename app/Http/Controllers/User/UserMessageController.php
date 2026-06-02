<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;


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

    abort_if($message->user_id !== auth()->id(), 403);

    $message->user_reply = $request->reply;
    $message->save();

    return back()->with('success', 'Votre réponse a été envoyée.');
}


}

