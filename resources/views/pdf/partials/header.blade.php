<h1>FACTURE</h1>

<div style="text-align:right;">
    <strong>Infortom</strong><br>
    SIRET : 93818904000034<br>
    12 impasse Saint Louis<br>
    06400 Cannes<br>
    contact@infortom.fr
</div>

<hr>

<p>
    <strong>Facture n° :</strong>
    {{ $facture->numero }}
</p>

<p>
    <strong>Référence devis :</strong>
    DEV-{{ $devis->id }}
</p>

<p>
    <strong>Date :</strong>
    {{ $facture->date_facture->format('d/m/Y') }}
</p>

@if($devis->is_company)
    <p><strong>Client professionnel :</strong> {{ $devis->company_name }}</p>
    <p><strong>Contact :</strong> {{ $devis->client_name }}</p>
    <p><strong>SIREN :</strong> {{ $devis->company_siren }}</p>

    @if($devis->company_vat_number)
        <p><strong>N° TVA intracommunautaire :</strong> {{ $devis->company_vat_number }}</p>
    @endif
@else
    <p><strong>Client :</strong> {{ $devis->client_name }}</p>
@endif

<p>
    <strong>Email :</strong>
    {{ $devis->client_email }}
</p>
<p><strong>Adresse postale :</strong> {{ $devis->client_address ?: 'Non renseignée' }}</p>

<h3>Prestations</h3>

<ul>
    @foreach($devis->items as $item)
        <li>{{ ucfirst(str_replace('_', ' ', $item)) }}</li>
    @endforeach
</ul>

<hr>
