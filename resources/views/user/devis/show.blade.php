@extends('layouts.app')

@section('content')
@php
use Illuminate\Support\Facades\Storage;
@endphp

<style>
.devis-show-background {
    background-image: url('{{ asset('images/home-background-new.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 40px 0;
    position: relative;
}

.devis-show-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: transparent;
    z-index: 1;
}

.devis-show-background > .container {
    position: relative;
    z-index: 2;
}
</style>
<style>
/* Texte du contrat en blanc */
.contract-text {
    color: white !important;
}

/* Liens en blanc */
.contract-links a {
    color: white !important;
    text-decoration: underline !important;
}

/* Boutons : texte blanc */
.contract-links .btn {
    color: white !important;
}

/* Titres en blanc */
.contract-section-title,
.contract-section-title h3,
.contract-section-title p,
.contract-section-title h4 {
    color: white !important;
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

        {{-- Détection des éléments personnalisés --}}
        @if(str_starts_with($item, 'custom:'))
            @php
                // Format : custom:Nom:Montant
                $parts = explode(':', $item);
                $customName = $parts[1] ?? 'Nom personnalisé';
                $customAmount = $parts[2] ?? 0;
            @endphp

            <li>
                <strong>{{ $customName }}</strong> — {{ $customAmount }} €
            </li>

        @else
            {{-- Affichage normal des prestations --}}
            <li>{{ ucfirst(str_replace('_', ' ', $item)) }}</li>
        @endif

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
        <hr>

<h3>Contrat généré</h3>

<pre class="contract-text" style="white-space: pre-wrap; font-size: 15px;">
{{ $contrat }}
</pre>



<div class="contract-links contract-section-title">

    <a href="{{ route('user.devis.download', $devis->id) }}"
       class="btn btn-primary" style="margin-top:20px;">
       Télécharger le contrat
    </a>

    @if($contratVisible)
        <hr>

        <h3>Contrat signé</h3>

        <a href="{{ route('user.devis.downloadSigned', $devis->id) }}" class="btn btn-primary">
           Télécharger le contrat signé
        </a>
    @else
        <hr>
        <p style="font-weight:bold;">
            Le contrat n'est pas encore signé par l'administrateur.
        </p>
    @endif

    <hr>

    <p style="font-weight:bold;">
        Signez le à votre tour :
    </p>

    <h4>Importer le contrat signé des deux parties</h4>

    <form action="{{ route('user.devis.uploadBoth', $devis->id) }}"
          method="POST" enctype="multipart/form-data">

        @csrf

        <input type="file" name="contrat_pdf_both" required>

        <button type="submit" class="btn btn-primary" style="margin-top:10px;">
            Importer le contrat signé des deux parties
        </button>
    </form>

    @if($devis->contrat_pdf_both)
        <a href="{{ route('user.devis.downloadBoth', $devis->id) }}"
           class="btn btn-success" style="margin-top:15px;">
            Télécharger le contrat signé des deux parties
        </a>
    @endif

</div>



    </div>
</div>

<footer style="background:black; color:white; text-align:center; padding:20px; margin-top:50px;">
    <a href="/support" style="color:white; text-decoration:underline;">Contactez le support</a>
</footer>

@endsection
