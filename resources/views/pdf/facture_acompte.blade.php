<h1>Facture - Acompte</h1>

@include('pdf.partials.header', ['devis' => $devis])

<h3>Acompte payé</h3>
<p><strong>200 €</strong></p>

<h3>Total TTC</h3>
<p><strong>{{ $devis->total_ttc }} €</strong></p>
