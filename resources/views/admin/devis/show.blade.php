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
            <li>{{ $labels[$item] ?? $item }}</li>
        @endforeach
    </ul>

    <h3>Total TTC : {{ $devis->total_ttc }} €</h3>
    <p><strong>Total HT :</strong> {{ $devis->total_ht }} €</p>
    <p><strong>TVA (20%) :</strong> {{ $devis->tva }} €</p>

    @if($devis->paiement_type === 'acompte')
        <p class="text-warning fw-bold">
            Acompte payé : 200 €<br>
            Reste à payer : {{ $devis->total_ttc - 200 }} €
        </p>
    @endif

</div>
@endsection
