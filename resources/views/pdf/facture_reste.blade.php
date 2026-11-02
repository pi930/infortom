<h1>Facture - Solde</h1>

<div style="position: absolute; top: 10px; right: 10px; text-align: right;">
    <strong>Infortom</strong><br>
    <span>SIRET : 93818904000034</span>
</div>

@include('pdf.partials.header', ['devis' => $devis])

<h3>Total du devis</h3>
<p><strong>{{ number_format($devis->total_ttc, 2, ',', ' ') }} €</strong></p>

<h3>Acompte déjà versé</h3>
<p><strong>100,00 €</strong></p>

<h3>Solde payé</h3>
<p><strong>{{ number_format($devis->total_ttc - 100, 2, ',', ' ') }} €</strong></p>

@include('pdf.partials.mentions')