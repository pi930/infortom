@extends('layouts.user')

@section('content')
<h2>Modifier mes informations</h2>

<form action="{{ route('user.update') }}" method="POST">
    @csrf

    <label>Nom</label>
    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">

    <label>Email</label>
    <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control">

    <label>Téléphone</label>
    <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control">

    <label>Adresse</label>
    <input type="text" name="address" value="{{ Auth::user()->address }}" class="form-control">

    <label>Code postal</label>
    <input type="text" name="postal_code" value="{{ Auth::user()->postal_code }}" class="form-control">

    <label>Ville</label>
    <input type="text" name="city" value="{{ Auth::user()->city }}" class="form-control">

    <button type="submit" class="btn btn-success" style="margin-top:15px;">Enregistrer</button>
</form>
@endsection

