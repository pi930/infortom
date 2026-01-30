<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Devis;


class AdminDashboardController extends Controller
{
    public function index()
{
    $messages = Message::latest()->get();
    $devis = Devis::orderBy('created_at', 'desc')->get();

    return view('admin.dashboard', compact('messages', 'devis'));
}

}

