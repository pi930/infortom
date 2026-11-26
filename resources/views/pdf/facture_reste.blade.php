@include('pdf.partials.header', [
    'devis' => $devis,
    'facture' => $facture
])

<h2>FACTURE DE SOLDE</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="8">

    <tr>
        <td>Total du devis</td>
        <td align="right">
            {{ number_format($devis->total_ttc, 2, ',', ' ') }} €
        </td>
    </tr>

    <tr>
        <td>Acompte déjà facturé</td>
        <td align="right">
            100,00 €
        </td>
    </tr>

    <tr>
        <td><strong>Solde facturé</strong></td>
        <td align="right">
            <strong>
                {{ number_format($devis->total_ttc - 100, 2, ',', ' ') }} €
            </strong>
        </td>
    </tr>

</table>

<br>

<p>
    Cette facture correspond au règlement du solde du devis DEV-{{ $devis->id }}.
</p>
<p style="margin-top:20px;">
    Solde reçu le
    {{ $facture->date_facture->format('d/m/Y') }}
</p>

@include('pdf.partials.footer')