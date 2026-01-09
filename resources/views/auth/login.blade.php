
@extends('layouts.app')

@section('content')

<h2 style="text-align:center; margin-bottom:30px;">Connexion</h2>

<form action="{{ route('login') }}" method="POST" style="max-width:400px; margin:auto;">
    @csrf

    <label>Email :</label>
    <input type="email" name="email" required style="width:100%; padding:10px; margin-bottom:15px;">

    <label>Mot de passe :</label>
    <input type="password" name="password" required style="width:100%; padding:10px; margin-bottom:15px;">

    <button type="submit" style="padding:12px 25px; background:#3f51b5; color:white; border:none; border-radius:6px;">
        Se connecter
    </button>
</form>

@endsection
