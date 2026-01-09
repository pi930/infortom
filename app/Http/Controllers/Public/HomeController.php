<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('public.home');
    }
    public function services()
{
    return view('public.services');
}
public function competences()
{
    return view('public.competences');
}

}

