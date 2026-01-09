<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

 public function register(Request $request)
{
    $request->validate([
        'name'         => 'required|string|max:255',
        'email'        => 'required|email|unique:users,email',
        'password'     => 'required|min:6|confirmed',
        'phone'        => 'nullable|string',
        'address'      => 'nullable|string',
        'city'         => 'nullable|string',
        'postal_code'  => 'nullable|string',
    ]);

    User::create([
        'name'        => $request->name,
        'email'       => $request->email,
        'password'    => Hash::make($request->password),
        'phone'       => $request->phone,
        'address'     => $request->address,
        'city'        => $request->city,
        'postal_code' => $request->postal_code,
        'role'        => 'user',
    ]);

    return redirect()->route('login')->with('success', 'Compte créé avec succès.');
}


}

