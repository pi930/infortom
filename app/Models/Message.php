<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
protected $fillable = [
    'name',
    'email',
    'client_address',
    'subject',
    'message',
    'phone',
    'reponse',
    'is_company',
'company_name',
'company_siren',
'company_vat_number',
];
protected $casts = [
    'is_company' => 'boolean',
];


    public function user()
{
    return $this->belongsTo(User::class);
}

}

