<?php

namespace App\Mail;

use App\Models\Devis;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceConfigMail extends Mailable
{
    use Queueable, SerializesModels;

    public $devis;
    public $data;

    public function __construct(Devis $devis, array $data)
    {
        $this->devis = $devis;
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject("Configuration de votre service")
                    ->view('emails.service_config');
    }
}

