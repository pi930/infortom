@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Devis #{{ $devis->id }}</h2>

    <p><strong>Total TTC :</strong> {{ $devis->total_ttc }} €</p>

    <h4>Prestations</h4>

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
    ];
    @endphp

    <ul>
        @foreach($devis->items as $item)
            <li>{{ $labels[$item] ?? $item }}</li>
        @endforeach
    </ul>

    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary mt-3">Retour</a>

</div>
@endsection



