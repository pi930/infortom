<p><strong>Devis :</strong> #{{ $devis->id }}</p>
<p><strong>Client :</strong> {{ $devis->client_name }}</p>
<p><strong>Email :</strong> {{ $devis->client_email }}</p>
<p><strong>Date :</strong> {{ $devis->paiement_date ? $devis->paiement_date->format('d/m/Y') : '—' }}</p>

<h3>Détails du devis</h3>

<ul>
    @foreach($devis->items as $item)
        <li>{{ ucfirst(str_replace('_', ' ', $item)) }}</li>
    @endforeach
</ul>

