@extends('layouts.app')

@section('content')

<style>
.message-show-background {
    background-image: url('{{ asset('images/home-background.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 40px 0;
    position: relative;
}

/* Voile sombre */
.message-show-background::before {
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
.message-show-background > .container {
    position: relative;
    z-index: 2;
}
</style>

<div class="message-show-background">
    <div class="container" style="max-width:800px; margin:auto;">

        <h2 style="text-align:center; font-size:28px; margin-bottom:30px; color:white;">
            Message : {{ $message->subject }}
        </h2>

        <div style="background:white; padding:20px; border-radius:8px; 
                    box-shadow:0 2px 8px rgba(0,0,0,0.1); margin-bottom:20px;">
            <strong>Votre message :</strong>
            <p>{{ $message->message }}</p>

            @if($message->reponse)
                <div style="margin-top:20px; background:#e9f5ff; padding:15px; border-radius:6px;">
                    <strong>Réponse de l’administrateur :</strong>
                    <p>{{ $message->reponse }}</p>
                </div>
            @endif

            @if($message->user_reply)
                <div style="margin-top:20px; background:#f1fff3; padding:15px; border-radius:6px;">
                    <strong>Votre réponse :</strong>
                    <p>{{ $message->user_reply }}</p>
                </div>
            @endif
        </div>

        {{-- Formulaire de réponse --}}
        <form action="{{ route('user.messages.reply', $message->id) }}" method="POST">
            @csrf

            <textarea name="reply" rows="4" style="width:100%; padding:10px; border-radius:6px; border:1px solid #ccc;" placeholder="Votre réponse..."></textarea>

            <button style="margin-top:15px; background:#007bff; color:white; padding:10px 15px; border:none; border-radius:5px;">
                Envoyer
            </button>
        </form>

    </div>
</div>

<footer style="background:black; color:white; text-align:center; padding:20px; margin-top:50px;">
    <a href="/support" style="color:white; text-decoration:underline;">Contactez le support</a>
</footer>

@endsection
