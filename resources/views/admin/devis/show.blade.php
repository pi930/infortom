@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Devis #{{ $devis->id }}</h2>

    <p><strong>Client :</strong> {{ $devis->client_name }}</p>
    <p><strong>Email :</strong> {{ $devis->client_email }}</p>

    <hr>

    <h4>Éléments sélectionnés</h4>

    <ul>
        @foreach($devis->items as $item)
            <li>{{ ucfirst(str_replace('_', ' ', $item)) }}</li>
        @endforeach
    </ul>

    <h3>Total TTC : {{ $devis->total_ttc }} €</h3>

</div>
@endsection

