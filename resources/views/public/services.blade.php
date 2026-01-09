@extends('layouts.app')

@section('content')

    <h2 style="text-align: center; font-size: 32px; margin-bottom: 40px;">
        Mes Services
    </h2>

    <div style="display: flex; flex-wrap: wrap; gap: 25px; justify-content: center;">

        <!-- Dépannage informatique -->
        <div style="width: 300px; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h3 style="font-size: 22px; margin-bottom: 10px;">Dépannage informatique</h3>
            <p style="color: #555;">
                Intervention rapide pour résoudre vos problèmes matériels et logiciels.
                Assistance à domicile ou à distance selon vos besoins.
            </p>
        </div>

        <!-- Développement web : sites de présentation -->
        <div style="width: 300px; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h3 style="font-size: 22px; margin-bottom: 10px;">Sites de présentation</h3>
            <p style="color: #555;">
                Création de sites vitrines modernes et élégants pour présenter votre activité,
                vos services ou votre portfolio.
            </p>
        </div>

        <!-- Développement web : sites de société -->
        <div style="width: 300px; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h3 style="font-size: 22px; margin-bottom: 10px;">Sites de société</h3>
            <p style="color: #555;">
                Développement de sites professionnels pour entreprises, avec pages dédiées,
                formulaires, gestion de contenu et design sur mesure.
            </p>
        </div>

        <!-- Développement web : sites de commerce -->
        <div style="width: 300px; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h3 style="font-size: 22px; margin-bottom: 10px;">Sites de commerce</h3>
            <p style="color: #555;">
                Création de boutiques en ligne performantes, sécurisées et faciles à gérer.
                Paiement en ligne, gestion des produits, commandes et clients.
            </p>
        </div>

    </div>

@endsection

