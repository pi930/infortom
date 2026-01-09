<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function profile()
    {
        return view('user.profile');
    }

    public function edit()
    {
        return view('user.edit');
    }

 public function update(Request $request)
{
    $user = Auth::user();

    $user->update([
        'name'        => $request->name,
        'email'       => $request->email,
        'phone'       => $request->phone,
        'address'     => $request->address,
        'postal_code' => $request->postal_code,
        'city'        => $request->city,
    ]);

    // 🔥 Rafraîchir l'utilisateur dans la session
    Auth::setUser($user->fresh());

    return redirect()->route('user.profile')->with('success', 'Profil mis à jour');
}


}