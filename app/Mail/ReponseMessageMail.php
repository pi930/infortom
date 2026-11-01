<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReponseMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageOriginal;
    public $reponse;

    public function __construct(Message $messageOriginal, string $reponse)
    {
        $this->messageOriginal = $messageOriginal;
        $this->reponse = $reponse;
    }

    public function build()
    {
        return $this->subject('Re : ' . $this->messageOriginal->subject)
                    ->view('emails.reponse-message');
    }
}
