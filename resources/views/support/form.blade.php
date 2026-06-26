@extends('layouts.app')

@section('content')

<style>
.support-background {
    background-image: url('{{ asset('images/home-background.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 40px 0;
    position: relative;
}

.support-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.35);
    z-index: 1;
}

.support-background > .container {
    position: relative;
    z-index: 2;
}
</style>

<div class="support-background">
    <div class="container" style="max-width:600px;margin:auto;padding:20px;">

        <h2 style="text-align:center;margin-bottom:20px;color:white;">
            Contactez le support
        </h2>

        @if(session('success'))
            <div style="background:#d4edda;padding:10px;border-radius:5px;margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('support.send') }}"
              style="background:white;padding:20px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);">
            @csrf

            <label>Nom :</label>
            <input type="text" name="name" value="{{ $user->name }}" required
                   style="width:100%;padding:10px;margin-bottom:15px;">

            <label>Email :</label>
            <input type="email" name="email" value="{{ $user->email }}" required
                   style="width:100%;padding:10px;margin-bottom:15px;">

            <label>Sujet :</label>
            <input type="text" name="subject" required
                   style="width:100%;padding:10px;margin-bottom:15px;">

            <label>Message :</label>
            <textarea name="message" rows="6" required
                      style="width:100%;padding:10px;margin-bottom:15px;"></textarea>

            <button type="submit"
                    style="background:#007bff;color:white;padding:10px 20px;border:none;border-radius:5px;cursor:pointer;">
                Envoyer
            </button>
        </form>

    </div>
</div>

@endsection
