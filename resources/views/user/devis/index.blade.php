@extends('layouts.app')

@section('content')

<style>
.devis-background {
    background-image: url('{{ asset('images/home-background-new.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 40px 0;
    position: relative;
}

.devis-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: transparent;
    z-index: 1;
}

.devis-background > .container {
    position: relative;
    z-index: 2;
}
</style>


<div class="devis-background">
    <div class="container" style="max-width:800px; margin:auto;">

        <h2 style="text-align:center; font-size:28px; margin-bottom:30px; color:white;">
            Mes Devis
        </h2>

        @forelse(auth()->user()->devis as $devis)
            <a href="{{ route('user.devis.show', $devis->id) }}" 
               style="text-decoration:none; color:inherit;">
                <div style="background:white; padding:20px; border-radius:8px; 
                            box-shadow:0 2px 8px rgba(0,0,0,0.1); margin-bottom:20px;">

                    <strong>Devis #{{ $devis->id }}</strong><br>
                    <small>{{ $devis->created_at->format('d/m/Y H:i') }}</small><br>

                    <strong>Total HT :</strong> {{ $devis->total_ht }} €<br>
                    <strong>Total TTC :</strong> {{ $devis->total_ttc }} €<br>

                    @if($devis->paiement_type === 'acompte')
                        <strong style="color:orange;">Acompte payé : 200 €</strong><br>
                        <strong>Reste à payer :</strong> {{ $devis->total_ttc - 200 }} €<br>
                    @endif

                    <strong>Statut :</strong>
                    @if($devis->statut === 'payé')
                        <span style="color:green; font-weight:bold;">Payé</span>
                    @elseif($devis->paiement_type === 'acompte')
                        <span style="color:orange; font-weight:bold;">Acompte payé</span>
                    @else
                        <span style="color:gray;">En attente</span>
                    @endif

                </div>
            </a>
        @empty
            <p style="color:white;">Aucun devis pour le moment.</p>
        @endforelse

    </div>
</div>

<footer style="background:black; color:white; text-align:center; padding:20px; margin-top:50px;">
    <a href="/support" style="color:white; text-decoration:underline;">Contactez le support</a>
</footer>

@endsection

