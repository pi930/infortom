<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devis;

class UserDevisController extends Controller
{
    public function show(Devis $devis)
    {
        abort_if($devis->user_id !== auth()->id(), 403);

        return view('user.devis.show', compact('devis'));
    }
}


