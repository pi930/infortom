<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
    'devis_id',
    'numero',
    'type',
    'montant',
    'montant_ht',
    'montant_ttc',
    'tva',
    'pdf_path',
    'date_facture',
    'email_envoye',
    'email_envoye_le',
    'qonto_invoice_id',
'qonto_status',
'qonto_attachment_id',
'qonto_sent_at',
'qonto_last_error',
];

    protected $casts = [
    'date_facture' => 'datetime',
    'email_envoye_le' => 'datetime',
    'email_envoye' => 'boolean',
    'qonto_sent_at' => 'datetime',
];

    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }
}
