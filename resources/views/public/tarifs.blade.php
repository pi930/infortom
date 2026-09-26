@extends('layouts.app')

@section('content')


<style>
    .tarifs-header {
        background: #e5e5e5;
        padding: 60px 20px;
        text-align: center;
        border-radius: 8px;
        margin-bottom: 40px;
    }

    .tarifs-header h1 {
        font-size: 36px;
        color: #3f8cff;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .tarifs-header p {
        font-size: 18px;
        color: #333;
        max-width: 900px;
        margin: auto;
        line-height: 1.6;
    }
</style>

<div class="tarifs-header">
    <h1>Nos tarifs clairs et accessibles</h1>

    <p>
        Chez infortom, nous accompagnons chaque nouvel auto‑entrepreneur avec une offre transparente,
        complète et sans frais cachés. Lancez votre présence en ligne en toute sérénité à Cannes
        et partout en France.
    </p>
</div>
<style>
    .tarifs-pack {
        background: #ffffff;
        padding: 50px 30px;
        border-radius: 8px;
        margin-bottom: 40px;
        text-align: center;
    }

    .tarifs-pack h2 {
        font-size: 32px;
        color: #3f8cff;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .tarifs-pack p {
        font-size: 18px;
        color: #333;
        max-width: 900px;
        margin: auto;
        line-height: 1.6;
        margin-bottom: 40px;
    }

    /* Tableau */
    .tarifs-table {
        width: 100%;
        max-width: 700px;
        margin: auto;
        border-collapse: collapse;
        font-size: 18px;
    }

    .tarifs-table th {
        background: #3f8cff;
        color: white;
        padding: 15px;
        border: 2px solid #000;
        font-size: 20px;
    }

    .tarifs-table td {
        padding: 15px;
        border: 2px solid #000;
        color: #000;
        background: #fff;
    }
</style>

<div class="tarifs-pack">
    <h2>Formule tout‑en‑un</h2>

    <p>
        Profitez d'un pack complet à <strong>200 € seulement</strong> (avec <strong>100 € d'acompte</strong> à la commande).
        Cette formule comprend la création de votre site web, les e‑mails automatiques, la gestion des devis,
        factures et paiements en ligne, l'hébergement, le nom de domaine, la maintenance réactive et le contrôle
        total sur votre code source.
    </p>

    <table class="tarifs-table">
        <tr>
            <th>Options</th>
            <th>Prix</th>
        </tr>

        <tr>
            <td>Site tout‑en‑un</td>
            <td>200 €</td>
        </tr>

        <tr>
            <td>Acompte</td>
            <td>100 €</td>
        </tr>

        <tr>
            <td>Nom de domaine</td>
            <td>6,00 €</td>
        </tr>

        <!-- 🔥 Nouvelle ligne ajoutée -->
        <tr>
            <td>Campagne réseaux sociaux</td>
            <td>100 € + coût de la campagne</td>

        </tr>
    </table>
</div>


<style>
    .cta-blue {
        background: #3f51b5;
        padding: 60px 30px;
        text-align: center;
        border-radius: 8px;
        margin-top: 40px;
        margin-bottom: 40px;
        color: white;
    }

    .cta-blue h2 {
        font-size: 34px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .cta-blue p {
        font-size: 18px;
        max-width: 900px;
        margin: auto;
        line-height: 1.6;
    }

    .footer-black {
        background: #000;
        color: #fff;
        text-align: center;
        padding: 15px 0;
        margin-top: 40px;
        border-radius: 6px;
        font-size: 14px;
    }
</style>

<div class="cta-blue">
    <h2>Prêt à propulser votre activité ?</h2>

    <p>
        Discutons de votre projet dès aujourd'hui et donnez à votre entreprise
        le site internet professionnel et fonctionnel qu'elle mérite.
    </p>
</div>

<div class="footer-black">
    © 2026 infortom
</div>

@endsection
