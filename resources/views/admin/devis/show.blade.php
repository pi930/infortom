@extends('layouts.admin')

@section('title', 'Devis #'.$devis->id)

@section('content')
<div class="container">

    <h2>Devis #{{ $devis->id }}</h2>

    <p><strong>Client :</strong> {{ $devis->client_name }}</p>
    <p><strong>Email :</strong> {{ $devis->client_email }}</p>

    <hr>

    @php
        $labels = [
            'deplacement' => 'Déplacement / Dépannage — 60 €',
            'ssd' => 'Disque dur SSD — 60 €',
            'carte_son' => 'Carte son — 60 €',
            'carte_reseau' => 'Carte réseau — 60 €',
            'blog' => 'Site vitrine / Blog — 250 €',
            'entreprise' => 'Site d\'entreprise — 500 €',
            'commercial' => 'Site commercial — 1000 €',
            'active_directory' => 'Serveur Active Directory — 1000 €',
            'windows_server_2025' => 'Windows Server 2025 — 1200 €',
            'hebergement' => 'Hébergement — 20 €',
            'email' => 'Email — 5 €',
        ];
    @endphp

    <h4>Prestations sélectionnées</h4>
    <ul>
    @foreach($devis->items as $item)

        @if(str_starts_with($item, 'custom:'))
            @php
                $parts = explode(':', $item);
                $customName = $parts[1] ?? 'Nom personnalisé';
                $customAmount = $parts[2] ?? 0;
            @endphp

            <li>
                <strong>{{ $customName }}</strong> — {{ $customAmount }} €
            </li>

        @else
            <li>{{ $labels[$item] ?? $item }}</li>
        @endif

    @endforeach
    </ul>

    <h3>Total TTC : {{ $devis->total_ttc }} €</h3>
    <p><strong>Total HT :</strong> {{ $devis->total_ht }} €</p>
    <p><strong>TVA :</strong> {{ $devis->tva }} €</p>

    @if($devis->paiement_type === 'acompte')
        <p class="text-warning fw-bold">
            Acompte payé : 200 €<br>
            Reste à payer : {{ $devis->total_ttc - 200 }} €
        </p>
    @endif

    <hr>

    <!-- 🔥 CONTRAT GÉNÉRÉ AUTOMATIQUEMENT -->
    <h3>Contrat généré</h3>

    <pre style="white-space: pre-wrap; font-size: 15px;">
{{ $contrat }}
    </pre>
    <hr>

<h3>Contrat généré</h3>

<pre style="white-space: pre-wrap; font-size: 15px;">
{{ $devis->contrat }}
</pre>

{{-- Bouton pour télécharger le contrat brut --}}
<a href="{{ route('admin.devis.download', $devis->id) }}"
   class="btn btn-primary" style="margin-top:20px;">
   Télécharger le contrat
</a>

{{-- Bouton pour importer le contrat signé --}}
<form action="{{ route('admin.devis.upload', $devis->id) }}" 
      method="POST" 
      enctype="multipart/form-data">

    @csrf

    <input type="file" name="contrat_pdf" required>

    <button type="submit" class="btn btn-primary">
        Importer le contrat signé
    </button>
</form>
@if($devis->contrat_pdf_both)
    <a href="{{ route('admin.devis.downloadBoth', $devis->id) }}"
       class="btn btn-primary" style="margin-top:20px;">
        Télécharger le contrat signé des deux parties
    </a>
@endif




</div>
@endsection
