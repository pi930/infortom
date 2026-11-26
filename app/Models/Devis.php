<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Devis extends Model
{
    use HasFactory;
     protected $fillable = [
    'client_name',
    'client_email',
    'items',
    'total_ht',
    'tva',
    'total_ttc',
    'acompte_possible',
    'paiement_type',
    'paiement_date',
    'user_id',
    'date',
    'heure',
    'statut',
    'acompte',
'reste_a_payer',
];


    protected $casts = [
        'items' => 'array',
        'paiement_date' => 'datetime',
    ];





    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function factures()
{
    return $this->hasMany(Facture::class);
}
    
}


