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
];


    protected $casts = [
        'date' => 'datetime',
    ];
}

