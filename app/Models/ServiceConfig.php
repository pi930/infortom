<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceConfig extends Model
{
    protected $table = 'service_configs';

    protected $fillable = [
        'devis_id',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }
}

