@extends('layouts.app')

@section('content')

<style>
.services-background {
    background-image: url('{{ asset('images/home-background-new.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 40px 0;
    position: relative;
}

/* Voile sombre */
.services-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: transparent;
    z-index: 1;
}

/* Contenu au-dessus du voile */
.services-background > .container {
    position: relative;
    z-index: 2;
}
</style>


<div class="services-background">
    <div class="container" style="max-width: 1100px; margin: auto;">

        <h2 style="text-align: center; font-size: 32px; margin-bottom: 40px; color:white;">
            Mes Services
        </h2>

        <div style="display: flex; flex-wrap: wrap; gap: 25px; justify-content: center;">

            <!-- Dépannage informatique -->
            <div style="width: 300px; background: white; padding: 25px; border-radius: 8px; 
                        box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <h3 style="font-size: 22px; margin-bottom: 10px;">Dépannage informatique</h3>
                <p style="color: #555;">
                    Intervention rapide pour résoudre vos problèmes matériels et logiciels.
                    Assistance à domicile ou à distance selon vos besoins.
                </p>
            </div>

            <!-- Sites de présentation -->
            <div style="width: 300px; background: white; padding: 25px; border-radius: 8px; 
                        box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <h3 style="font-size: 22px; margin-bottom: 10px;">Sites de présentation</h3>
                <p style="color: #555;">
                    Création de sites vitrines modernes et élégants pour présenter votre activité,
                    vos services ou votre portfolio.
                </p>
            </div>

            <!-- Sites de société -->
            <div style="width: 300px; background: white; padding: 25px; border-radius: 8px; 
                        box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <h3 style="font-size: 22px; margin-bottom: 10px;">Sites de société</h3>
                <p style="color: #555;">
                    Développement de sites professionnels pour entreprises, avec pages dédiées,
                    formulaires, gestion de contenu et design sur mesure.
                </p>
            </div>

            <!-- Sites de commerce -->
            <div style="width: 300px; background: white; padding: 25px; border-radius: 8px; 
                        box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <h3 style="font-size: 22px; margin-bottom: 10px;">Sites de commerce</h3>
                <p style="color: #555;">
                    Création de boutiques en ligne performantes, sécurisées et faciles à gérer.
                    Paiement en ligne, gestion des produits, commandes et clients.
                </p>
            </div>

            <!-- Active Directory -->
            <div style="width: 300px; background: white; padding: 25px; border-radius: 8px; 
                        box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <h3 style="font-size: 22px; margin-bottom: 10px;">Réalisation de serveur Active Directory</h3>
                <p style="color: #555;">
                    Mise en place complète d’un serveur Active Directory professionnel : installation AD DS,
                    configuration DNS, création d’unités d’organisation, gestion des utilisateurs et groupes,
                    jonction des postes au domaine et déploiement de stratégies GPO.
                </p>
            </div>

        </div>

    </div>
</div>

@endsection
