@extends('layouts.app')

@section('content')
<h2>Devis #{{ $devis->id }}</h2>

<p><strong>Prestations :</strong> {{ implode(', ', $devis->items) }}</p>
<p><strong>Total TTC :</strong> {{ $devis->total_ttc }} €</p>

@if($devis->date)
<p><strong>Date :</strong> {{ $devis->date }}</p>
@endif

@if($devis->heure)
<p><strong>Heure :</strong> {{ $devis->heure }}</p>
@endif

<a href="{{ route('panier.fromDevis', $devis->id) }}"
   style="background:#4CAF50; color:white; padding:10px 20px; border-radius:5px; text-decoration:none;">
    Ajouter au panier / Procéder au paiement
</a>
@endsection


