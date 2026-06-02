<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Le tableau de bord utilisateur affiche uniquement les compétences
        return view('user.dashboard');

    }
}
