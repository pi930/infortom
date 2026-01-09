<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller
{
    public function index()
    {
        return view('public.contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

      Message::create([
    'user_id' => auth()->id(),
    'name'    => $request->name,
    'email'   => $request->email,
    'subject' => $request->subject,
    'message' => $request->message,
]);


        return redirect()->route('contact')->with('success', 'Votre message a été envoyé.');
    }
}

