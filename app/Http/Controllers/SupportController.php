<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        return view('support.form', [
            'user' => $request->user()
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // 1) Email envoyé à contact@infortom.fr
        Mail::raw(
            "Message reçu de : {$request->name}\nEmail : {$request->email}\n\n{$request->message}",
            function ($m) use ($request) {
                $m->to('contact@infortom.fr')
                  ->subject('[Support] ' . $request->subject);
            }
        );

        // 2) Email de remerciement envoyé à l’utilisateur
        Mail::raw(
            "Bonjour {$request->name},\n\nNous avons bien reçu votre message.\nNous traiterons votre demande dans les plus brefs délais.\n\nCordialement,\nL’équipe Infortom",
            function ($m) use ($request) {
                $m->to($request->email)
                  ->subject('Merci pour votre message');
            }
        );

        return back()->with('success', 'Votre message a bien été envoyé.');
    }
}

