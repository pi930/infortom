<h1>Facture - Reste à payer</h1>

<div style="position: absolute; top: 10px; right: 10px; text-align: right;">
    <strong>Infortom</strong><br>
    <span>SIRET : 93818904000034</span>
</div>

@include('pdf.partials.header', ['devis' => $devis])

<h3>Reste payé</h3>
<p><strong>{{ $devis->total_ttc - 200 }} €</strong></p>

<h3>Total TTC</h3>
<p><strong>{{ $devis->total_ttc }} €</strong></p>
