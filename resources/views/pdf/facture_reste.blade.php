<h1>Facture - Reste à payer</h1>

@include('pdf.partials.header', ['devis' => $devis])

<h3>Reste payé</h3>
<p><strong>{{ $devis->total_ttc - 200 }} €</strong></p>

<h3>Total TTC</h3>
<p><strong>{{ $devis->total_ttc }} €</strong></p>
