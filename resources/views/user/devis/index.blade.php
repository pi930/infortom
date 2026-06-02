@extends('layouts.app')

@section('content')

<h2 style="text-align:center; font-size:28px; margin-bottom:30px;">
    Mes Devis
</h2>

<div style="max-width:800px; margin:auto;">

    @forelse(auth()->user()->devis as $devis)
        <a href="{{ route('user.devis.show', $devis->id) }}" 
           style="text-decoration:none; color:inherit;">
            <div style="background:white; padding:20px; border-radius:8px; 
                        box-shadow:0 2px 8px rgba(0,0,0,0.1); margin-bottom:20px;">
                <strong>Devis #{{ $devis->id }}</strong><br>
                <small>{{ $devis->created_at->format('d/m/Y H:i') }}</small><br>
                <strong>Total :</strong> {{ $devis->total_ttc }} €
            </div>
        </a>
    @empty
        <p>Aucun devis pour le moment.</p>
    @endforelse

</div>

<footer style="background:black; color:white; text-align:center; padding:20px; margin-top:50px;">
    <a href="/support" style="color:white; text-decoration:underline;">Contactez le support</a>
</footer>

@endsection

