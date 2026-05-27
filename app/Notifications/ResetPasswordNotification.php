<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url('/password/reset/'.$this->token.'?email='.$notifiable->email);

        return (new MailMessage)
            ->subject('Réinitialisation de votre mot de passe')
            ->greeting('Bonjour '.$notifiable->name.' !')
            ->line('Vous avez demandé la réinitialisation de votre mot de passe.')
            ->action('Réinitialiser mon mot de passe', $url)
            ->line('Si vous n’êtes pas à l’origine de cette demande, ignorez cet email.');
    }
}
