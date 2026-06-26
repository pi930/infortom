@extends('layouts.app')

@section('content')

<style>
.mentions-background {
    background-image: url('{{ asset('images/home-background.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 40px 0;
    position: relative;
}

.mentions-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.35);
    z-index: 1;
}

.mentions-background > .container {
    position: relative;
    z-index: 2;
}
</style>

<div class="mentions-background">
    <div class="container" style="max-width:900px; margin:auto; padding:30px; line-height:1.7; background:white; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">

        <h2 style="margin-bottom:20px;">Informations légales</h2>

        <p><strong>Entreprise :</strong> Infortom</p>
        <p><strong>Statut juridique :</strong> Micro‑entreprise</p>
        <p><strong>Adresse :</strong> 12 impasse Saint Louis, 06400 Cannes</p>
        <p><strong>SIRET :</strong> 93818904000026</p>
        <p><strong>Chiffre d’affaires :</strong> 0 € (entreprise en développement)</p>

        <h3>Responsable de la publication</h3>
        <p>Thomas</p>

        <h3>Contact</h3>
        <p>Via la page « Support » du site.</p>

        <h3>Hébergement</h3>
        <p>
            Le site est hébergé par :<br>
            <strong>Render.com</strong><br>
            Plateforme d’hébergement cloud.
        </p>

        <h3>Propriété intellectuelle</h3>
        <p>
            L’ensemble du contenu du site (textes, images, logos, code) est protégé par le droit d’auteur.
            Toute reproduction, modification ou diffusion sans autorisation est interdite.
        </p>

        <h3>Limitation de responsabilité</h3>
        <p>
            L’entreprise ne peut être tenue responsable en cas d’erreur, d’interruption ou de dysfonctionnement du site.
        </p>

        <h3>Données personnelles</h3>
        <p>
            Les informations concernant la gestion des données personnelles sont détaillées dans la page
            <a href="/confidentialite" style="color:#007bff;">Déclaration de confidentialité</a>.
        </p>

    </div>
</div>

@endsection

