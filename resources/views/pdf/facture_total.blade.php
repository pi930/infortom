@include('pdf.partials.header', [
    'devis' => $devis,
    'facture' => $facture
])

<h2>FACTURE</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="8">

    <tr>
        <th align="left">Description</th>
        <th align="right">Montant</th>
    </tr>

    <tr>
        <td>Prestations selon devis DEV-{{ $devis->id }}</td>
        <td align="right">
            {{ number_format($devis->total_ht, 2, ',', ' ') }} €
        </td>
    </tr>

    <tr>
        <td>TVA</td>
        <td align="right">
            0,00 €
        </td>
    </tr>

    <tr>
        <td><strong>Total TTC</strong></td>
        <td align="right">
            <strong>
                {{ number_format($devis->total_ttc, 2, ',', ' ') }} €
            </strong>
        </td>
    </tr>

</table>


<p style="margin-top:20px;">
    <strong>Montant réglé :</strong>
    {{ number_format($devis->total_ttc, 2, ',', ' ') }} €
</p>

<p>
    Paiement intégral reçu le
    {{ $facture->date_facture->format('d/m/Y') }}
</p>

@include('pdf.partials.footer')