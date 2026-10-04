@extends('layouts.app')

@section('content')

<style>
    .legal-page {
        background: #f1f3f6;
        padding: 50px 40px;
        border-radius: 12px;
        margin-top: 20px;
    }

    .legal-inner {
        max-width: 900px;
        margin: 0 auto;
    }

    .legal-page h1 {
        font-size: 34px;
        font-weight: 800;
        color: #1e3a8a;
        text-align: center;
        margin-bottom: 10px;
    }

    .legal-intro {
        text-align: center;
        font-size: 16px;
        color: #333;
        max-width: 700px;
        margin: 0 auto 35px auto;
        line-height: 1.6;
    }

    .legal-card {
        background: white;
        padding: 28px 30px;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .legal-card h2 {
        font-size: 22px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f3f6;
    }

    .legal-card p {
        font-size: 15px;
        color: #333;
        line-height: 1.7;
        margin-bottom: 8px;
    }

    .legal-card ul {
        margin: 10px 0 0 0;
        padding-left: 20px;
    }

    .legal-card li {
        font-size: 15px;
        color: #333;
        line-height: 1.7;
        margin-bottom: 4px;
    }

    .legal-highlight {
        background: #f8f9ff;
        padding: 15px 18px;
        border-radius: 8px;
        margin-top: 10px;
    }

    .legal-back {
        text-align: center;
        margin-top: 30px;
    }

    .legal-btn {
        background: #1e3a8a;
        color: white;
        padding: 12px 22px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 16px;
        display: inline-block;
    }

    @media (max-width: 600px) {
        .legal-page { padding: 25px 15px; }
        .legal-page h1 { font-size: 26px; }
        .legal-card { padding: 20px; }
        .legal-btn { width: 90%; text-align: center; }
    }
</style>

<div class="legal-page">
    <div class="legal-inner">

        <h1>Déclaration de confidentialité</h1>
        <p class="legal-intro">
            L’entreprise s’engage à respecter la confidentialité des informations collectées et à assurer
            leur protection conformément au Règlement Général sur la Protection des Données (RGPD).
        </p>

        <div class="legal-card">
            <h2>1. Données collectées</h2>
            <p>Les données susceptibles d’être collectées sont :</p>
            <ul>
                <li>informations transmises via les formulaires (nom, email, message),</li>
                <li>données techniques nécessaires au fonctionnement du site (adresse IP, logs techniques),</li>
                <li>informations liées aux demandes de contact ou de devis.</li>
            </ul>
        </div>

        <div class="legal-card">
            <h2>2. Finalité du traitement</h2>
            <p>Les données sont utilisées uniquement pour :</p>
            <ul>
                <li>répondre aux demandes des utilisateurs,</li>
                <li>améliorer la qualité des services proposés,</li>
                <li>assurer la sécurité et la maintenance du site.</li>
            </ul>
            <div class="legal-highlight">
                <p style="margin:0;">Aucune donnée n’est utilisée à des fins commerciales ou publicitaires.</p>
            </div>
        </div>

        <div class="legal-card">
            <h2>3. Conservation des données</h2>
            <p>
                Les données sont conservées uniquement le temps nécessaire au traitement de la demande
                ou à l’amélioration du service.
            </p>
        </div>

        <div class="legal-card">
            <h2>4. Partage des données</h2>
            <p>
                Les données ne sont <strong>jamais vendues</strong>, <strong>jamais échangées</strong>,
                <strong>jamais transmises</strong> à des tiers.
            </p>
        </div>

        <div class="legal-card">
            <h2>5. Vos droits</h2>
            <p>Conformément au RGPD, vous disposez des droits suivants :</p>
            <ul>
                <li>droit d’accès,</li>
                <li>droit de rectification,</li>
                <li>droit à l’effacement,</li>
                <li>droit d’opposition.</li>
            </ul>
            <p style="margin-top:12px;">
                Vous pouvez exercer vos droits en contactant le support via la page dédiée.
            </p>
        </div>

        <div class="legal-card">
            <h2>6. Sécurité</h2>
            <p>
                L’entreprise met en œuvre toutes les mesures nécessaires pour protéger les données
                contre tout accès non autorisé.
            </p>
        </div>

        <div class="legal-back">
            <a href="{{ url('/') }}" class="legal-btn">Retour à l'accueil</a>
        </div>

    </div>
</div>

@endsection

