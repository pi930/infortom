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
        'pdf_path',
        'date_facture',
    ];

    protected $casts = [
        'date_facture' => 'datetime',
    ];

    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }
}
