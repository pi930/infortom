@extends('layouts.app')

@section('content')

<style>
.register-background {
    background-image: url('{{ asset('images/home-background-new.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 60px 0;
    position: relative;
}


.register-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: transparent;
    z-index: 1;
}

.register-background > .container {
    position: relative;
    z-index: 2;
}
</style>

<div class="register-background">
    <div class="container" style="max-width:400px;margin:auto;">

        <h2 style="text-align:center; margin-bottom:30px; color:white;">
            Inscription
        </h2>

        <form action="{{ route('register') }}" method="POST"
              style="background:white;padding:25px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);">
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

    </div>
</div>

@endsection
