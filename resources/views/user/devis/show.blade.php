@extends('layouts.app')

@section('content')

<h2 style="text-align:center; font-size:28px; margin-bottom:30px;">
    Détail du devis #{{ $devis->id }}
</h2>

<div style="max-width:800px; margin:auto; background:white; padding:25px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">

    <p><strong>Services :</strong></p>
    <ul>
        @foreach($devis->items as $item)
            <li>{{ ucfirst(str_replace('_', ' ', $item)) }}</li>
        @endforeach
    </ul>

    <p><strong>Total HT :</strong> {{ $devis->total_ht }} €</p>
    <p><strong>TVA (20%) :</strong> {{ $devis->tva }} €</p>
    <p><strong>Total TTC :</strong> {{ $devis->total_ttc }} €</p>

    {{-- Acompte payé --}}
    @if($devis->paiement_type === 'acompte')
        <p style="color:orange; font-weight:bold;">
            Acompte payé : 200 €<br>
            Reste à payer : {{ $devis->total_ttc - 200 }} €
        </p>
    @endif

    {{-- Boutons de paiement --}}
    @if($devis->statut !== 'payé')
        <a href="{{ route('paiement.total', $devis->id) }}" 
           class="btn btn-primary" style="margin-top:15px; display:inline-block;">
            Payer le montant total
        </a>

        @if($devis->acompte_possible && $devis->paiement_type !== 'acompte')
            <a href="{{ route('paiement.acompte', $devis->id) }}" 
               class="btn btn-warning" style="margin-left:10px; margin-top:15px; display:inline-block;">
                Payer un acompte de 200 €
            </a>
        @endif
    @endif
    @if($devis->paiement_type === 'acompte')
    <a href="{{ route('paiement.reste', $devis->id) }}"
       class="btn btn-success" style="margin-top:15px;">
        Payer le reste ({{ $devis->total_ttc - 200 }} €)
    </a>
@endif


    <p><strong>Date :</strong> {{ $devis->created_at->format('d/m/Y H:i') }}</p>

</div>

<footer style="background:black; color:white; text-align:center; padding:20px; margin-top:50px;">
    <a href="/support" style="color:white; text-decoration:underline;">Contactez le support</a>
</footer>

@endsection
