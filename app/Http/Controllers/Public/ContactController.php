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
    'email'   => 'required|email|max:255',
    'subject' => 'required|string|max:255',
    'message' => 'required|string|max:5000',
    'phone'   => 'nullable|string|max:20',
]);

       Message::create([
    'name'    => $request->name,
    'email'   => $request->email,
    'subject' => $request->subject,
    'message' => $request->message,
    'phone'   => $request->phone,
]);


        return redirect()->route('contact')->with('success', 'Votre message a été envoyé.');
    }
}
