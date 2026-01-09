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
}

