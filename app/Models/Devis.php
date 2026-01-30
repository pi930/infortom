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
    'total_ttc',
    'user_id',
    'date',
    'heure',
    'statut',
];


    protected $casts = [
        'items' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}


