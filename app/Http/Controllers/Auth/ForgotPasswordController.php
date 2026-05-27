<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // Affiche la page pour entrer l'email
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Envoie l'email de réinitialisation
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Envoi du lien
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Un email de réinitialisation vous a été envoyé.')
            : back()->withErrors(['email' => 'Impossible d\'envoyer le lien à cette adresse.']);
    }
}