@extends('layouts.app')

@section('content')

<style>
.messages-background {
    background-image: url('{{ asset('images/home-background-new.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 40px 0;
    position: relative;
}

/* Voile sombre */
.messages-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.35);
    z-index: 1;
}

/* Contenu au-dessus du voile */
.messages-background > .container {
    position: relative;
    z-index: 2;
}
</style>

<div class="messages-background">
    <div class="container" style="max-width:800px; margin:auto;">

        <h2 style="text-align:center; font-size:28px; margin-bottom:30px; color:white;">
            Mes Messages
        </h2>

        @forelse($messages as $msg)
            <a href="{{ route('user.messages.show', $msg->id) }}" 
               style="text-decoration:none; color:inherit;">
                <div style="background:white; padding:20px; border-radius:8px; 
                            box-shadow:0 2px 8px rgba(0,0,0,0.1); margin-bottom:20px;">
                    <strong>Sujet :</strong> {{ $msg->subject }}<br>
                    <small>Envoyé le {{ $msg->created_at->format('d/m/Y H:i') }}</small>
                </div>
            </a>
        @empty
            <p style="color:white;">Aucun message pour le moment.</p>
        @endforelse

    </div>
</div>

<footer style="background:black; color:white; text-align:center; padding:20px; margin-top:50px;">
    <a href="/support" style="color:white; text-decoration:underline;">Contactez le support</a>
</footer>

@endsection


