
@extends('layouts.app')

@section('content')

<h2 style="text-align:center; margin-bottom:30px;">Inscription</h2>

<form action="{{ route('register') }}" method="POST" style="max-width:400px; margin:auto;">
    @csrf

    <label>Nom :</label>
    <input type="text" name="name" required style="width:100%; padding:10px; margin-bottom:15px;">

    <label>Email :</label>
    <input type="email" name="email" required style="width:100%; padding:10px; margin-bottom:15px;">

    <label>Téléphone :</label>
    <input type="text" name="phone" style="width:100%; padding:10px; margin-bottom:15px;">

    <label>Rue :</label>
    <input type="text" name="address" style="width:100%; padding:10px; margin-bottom:15px;">

    <label>Code postal :</label>
    <input type="text" name="postal_code" style="width:100%; padding:10px; margin-bottom:15px;">

    <label>Ville :</label>
    <input type="text" name="city" style="width:100%; padding:10px; margin-bottom:15px;">

    <label>Mot de passe :</label>
    <input type="password" name="password" required style="width:100%; padding:10px; margin-bottom:15px;">

    <label>Confirmer le mot de passe :</label>
    <input type="password" name="password_confirmation" required style="width:100%; padding:10px; margin-bottom:15px;">

    <button type="submit" style="padding:12px 25px; background:#4caf50; color:white; border:none; border-radius:6px;">
        S'inscrire
    </button>
</form>

@endsection

