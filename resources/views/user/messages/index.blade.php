@extends('layouts.app')

@section('content')

<h2 style="text-align:center; font-size:28px; margin-bottom:30px;">
    Mes Messages
</h2>

<div style="max-width:800px; margin:auto;">

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
        <p>Aucun message pour le moment.</p>
    @endforelse

</div>

<footer style="background:black; color:white; text-align:center; padding:20px; margin-top:50px;">
    <a href="/support" style="color:white; text-decoration:underline;">Contactez le support</a>
</footer>

@endsection

