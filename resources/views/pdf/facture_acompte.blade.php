@include('pdf.partials.header', [
    'devis' => $devis,
    'facture' => $facture
])

<h2>FACTURE D'ACOMPTE</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="8">

    <tr>
        <th align="left">Description</th>
        <th align="right">Montant</th>
    </tr>

    <tr>
        <td>Acompte sur devis DEV-{{ $devis->id }}</td>
        <td align="right">100,00 €</td>
    </tr>

    <tr>
        <td><strong>Total facturé</strong></td>
        <td align="right">
            <strong>100,00 €</strong>
        </td>
    </tr>

</table>

<br>

<p>
    Montant total du devis :
    {{ number_format($devis->total_ttc, 2, ',', ' ') }} €
</p>

<p>
    Cette facture correspond à l'acompte versé par le client.
</p>


<p style="margin-top:20px;">
    <strong>Montant facturé :</strong>
    100,00 €
</p>

<p>
    Acompte reçu le
    {{ $facture->date_facture->format('d/m/Y') }}
</p>

@include('pdf.partials.footer')
