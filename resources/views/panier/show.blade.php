@extends('layouts.app')

@section('content')
    <h2>Votre panier</h2>

    @if(!$total)
        <p>Aucun devis en cours.</p>
    @else
        <div style="background:white; padding:20px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); max-width:600px;">
            
            <p><strong>Service :</strong> {{ $service }}</p>
            <p><strong>Date du rendez-vous :</strong> {{ $date }}</p>
            <p><strong>Heure :</strong> {{ $heure }}</p>
            <p><strong>Total TTC :</strong> {{ $total }} €</p>

           <form action="{{ route('paiement.checkout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-success">
        Procéder au paiement
    </button>
</form>

        </div>
    @endif
@endsection

