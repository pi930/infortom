<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coordonnee extends Model
{
    protected $table = 'coordonnee'; // ou 'coordonneeS' selon ta migration

    protected $fillable = [
        'nom',
        'rue',
        'code_postal',
        'ville',
        'telephone',
        'email',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

