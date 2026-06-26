@extends('layouts.app')

@section('content')

<style>
.confidentialite-background {
    background-image: url('{{ asset('images/home-background.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 40px 0;
    position: relative;
}

.confidentialite-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.35);
    z-index: 1;
}

.confidentialite-background > .container {
    position: relative;
    z-index: 2;
}
</style>

<div class="confidentialite-background">
    <div class="container" style="max-width:900px; margin:auto; padding:30px; line-height:1.7; background:white; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1);">

        <h2 style="margin-bottom:20px;">Déclaration de confidentialité</h2>

        <p>
            L’entreprise s’engage à respecter la confidentialité des informations collectées et à assurer leur protection conformément au Règlement Général sur la Protection des Données (RGPD).
        </p>

        <h3>1. Données collectées</h3>
        <p>
            Les données susceptibles d’être collectées sont :
            <br>– informations transmises via les formulaires (nom, email, message),
            <br>– données techniques nécessaires au fonctionnement du site (adresse IP, logs techniques),
            <br>– informations liées aux demandes de contact ou de devis.
        </p>

        <h3>2. Finalité du traitement</h3>
        <p>
            Les données sont utilisées uniquement pour :
            <br>– répondre aux demandes des utilisateurs,
            <br>– améliorer la qualité des services proposés,
            <br>– assurer la sécurité et la maintenance du site.
            <br><br>
            Aucune donnée n’est utilisée à des fins commerciales ou publicitaires.
        </p>

        <h3>3. Conservation des données</h3>
        <p>
            Les données sont conservées uniquement le temps nécessaire au traitement de la demande ou à l’amélioration du service.
        </p>

        <h3>4. Partage des données</h3>
        <p>
            Les données ne sont <strong>jamais vendues</strong>, <strong>jamais échangées</strong>, <strong>jamais transmises</strong> à des tiers.
        </p>

        <h3>5. Vos droits</h3>
        <p>
            Conformément au RGPD, vous disposez des droits suivants :
            <br>– droit d’accès,
            <br>– droit de rectification,
            <br>– droit à l’effacement,
            <br>– droit d’opposition.
            <br><br>
            Vous pouvez exercer vos droits en contactant le support via la page dédiée.
        </p>

        <h3>6. Sécurité</h3>
        <p>
            L’entreprise met en œuvre toutes les mesures nécessaires pour protéger les données contre tout accès non autorisé.
        </p>

    </div>
</div>

@endsection

