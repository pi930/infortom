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
    <p><strong>Total TTC :</strong> {{ $devis->total_ttc }} €</p>
    <p><strong>Statut :</strong>
        @if($devis->statut === 'payé')
            <span style="color:green; font-weight:bold;">Payé</span>
        @elseif($devis->statut === 'accepté')
            <span style="color:blue; font-weight:bold;">Accepté</span>
        @else
            <span style="color:gray;">En attente</span>
        @endif
    </p>

    <p><strong>Date :</strong> {{ $devis->created_at->format('d/m/Y H:i') }}</p>

</div>

<footer style="background:black; color:white; text-align:center; padding:20px; margin-top:50px;">
    <a href="/support" style="color:white; text-decoration:underline;">Contactez le support</a>
</footer>

@endsection
