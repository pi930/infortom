@extends('layouts.app')

@section('content')

<style>
.devis-show-background {
    background-image: url('{{ asset('images/home-background.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 40px 0;
    position: relative;
}

/* Voile sombre */
.devis-show-background::before {
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
.devis-show-background > .container {
    position: relative;
    z-index: 2;
}
</style>

<div class="devis-show-background">
    <div class="container" style="max-width:800px; margin:auto;">

        <h2 style="text-align:center; font-size:28px; margin-bottom:30px; color:white;">
            Détail du devis #{{ $devis->id }}
        </h2>

        <div style="background:white; padding:25px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">

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

            {{-- Icône de téléchargement de facture --}}
            @php
                $filename = "facture_{$devis->paiement_type}_devis_{$devis->id}.pdf";
            @endphp

            @if(in_array($devis->paiement_type, ['total', 'acompte', 'reste']) 
                && Storage::exists("factures/$filename"))
                
                <a href="{{ asset('storage/factures/'.$filename) }}" 
                style="display:inline-flex; align-items:center; margin-top:20px; 
                        color:#007bff; font-weight:bold; text-decoration:none;">
                    
                    <svg style="width:22px; margin-right:8px;" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5-.5h4v-8a.5.5 0 0 1 1 0v8h4a.5.5 0 0 1 .354.854l-4 4a.5.5 0 0 1-.708 0l-4-4A.5.5 0 0 1 .5 9.9z"/>
                    </svg>

                    Télécharger la facture
                </a>
            @endif

            <p><strong>Date :</strong> {{ $devis->created_at->format('d/m/Y H:i') }}</p>

        </div>

    </div>
</div>

<footer style="background:black; color:white; text-align:center; padding:20px; margin-top:50px;">
    <a href="/support" style="color:white; text-decoration:underline;">Contactez le support</a>
</footer>

@endsection
