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
        margin-bottom: 35px;
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

    .legal-card a {
        color: #1e3a8a;
        font-weight: 600;
    }

    .legal-info {
        background: #f8f9ff;
        padding: 15px 18px;
        border-radius: 8px;
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

        <h1>Mentions légales</h1>
        <p class="legal-intro">Informations légales relatives au site Infortom.</p>

        <div class="legal-card">
            <h2>Informations légales</h2>
            <div class="legal-info">
                <p><strong>Entreprise :</strong> Infortom</p>
                <p><strong>Statut juridique :</strong> Micro‑entreprise</p>
                <p><strong>Adresse :</strong> 12 impasse Saint Louis, 06400 Cannes</p>
                <p><strong>SIRET :</strong> 93818904000034</p>
            </div>
        </div>

        <div class="legal-card">
            <h2>Responsable de la publication</h2>
            <p>Thomas</p>
        </div>

        <div class="legal-card">
            <h2>Contact</h2>
            <p>Via la page « Support » du site.</p>
            <p>Téléphone : 07 43 33 44 24</p>
        </div>

        <div class="legal-card">
            <h2>Hébergement</h2>
            <p>Le site est hébergé par :</p>
            <p><strong>Render.com</strong><br>Plateforme d’hébergement cloud.</p>
        </div>

        <div class="legal-card">
            <h2>Propriété intellectuelle</h2>
            <p>
                L’ensemble du contenu du site (textes, images, logos, code) est protégé par le droit d’auteur.
                Toute reproduction, modification ou diffusion sans autorisation est interdite.
            </p>
        </div>

        <div class="legal-card">
            <h2>Limitation de responsabilité</h2>
            <p>
                L’entreprise ne peut être tenue responsable en cas d’erreur, d’interruption ou de dysfonctionnement du site.
            </p>
        </div>

        <div class="legal-card">
            <h2>Données personnelles</h2>
            <p>
                Les informations concernant la gestion des données personnelles sont détaillées dans la page
                <a href="{{ route('confidentialite') }}">Déclaration de confidentialité</a>.
            </p>
        </div>

        <div class="legal-back">
            <a href="{{ url('/') }}" class="legal-btn">Retour à l'accueil</a>
        </div>

    </div>
</div>

@endsection