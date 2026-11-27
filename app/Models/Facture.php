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
];

    protected $casts = [
    'date_facture' => 'datetime',
    'email_envoye_le' => 'datetime',
    'email_envoye' => 'boolean',
];

    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }
}
