@extends('layouts.user')

@section('content')
<h2>Mon profil</h2>

<div class="card" style="padding:20px; max-width:500px;">
    <p><strong>Nom :</strong> {{ Auth::user()->name }}</p>
    <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
    <p><strong>Téléphone :</strong> {{ Auth::user()->phone }}</p>
    <p><strong>Adresse :</strong> {{ Auth::user()->address }}</p>
    <p><strong>Code postal :</strong> {{ Auth::user()->postal_code }}</p>
    <p><strong>Ville :</strong> {{ Auth::user()->city }}</p>

    <a href="{{ route('user.edit') }}" class="btn btn-primary" style="margin-top:15px;">
        Modifier mes informations
    </a>
</div>
@endsection

