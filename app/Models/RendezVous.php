<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RendezVous extends Model
{
protected $table = 'rendez_vous';

protected $fillable = [
'date',
'nom',
'rue',
'ville',
'telephone',
'user_id',
'confirmed',
'type',
'meet_link',
'email_sent',
'confirmation_mail_sent'
];

protected $casts = [
'date' => 'datetime',
'confirmed' => 'boolean',
'email_sent' => 'boolean',
'confirmation_mail_sent' => 'boolean',
];
}

