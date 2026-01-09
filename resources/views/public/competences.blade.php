@extends('layouts.app')

@section('content')

    <h2 style="text-align: center; font-size: 32px; margin-bottom: 40px;">
        Mes Compétences
    </h2>

    <div style="max-width: 900px; margin: auto;">

        <!-- Création de sites web -->
        <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 25px;">
            <h3 style="font-size: 22px; margin-bottom: 10px;">Création de sites web</h3>
            <p style="color: #555;">
                J’ai réalisé deux sites web complets, incluant la conception, le développement,
                l’intégration et la mise en ligne.  
                Ces projets m’ont permis de maîtriser la structure d’un site moderne, la gestion
                des pages, l’ergonomie et l’optimisation.
            </p>

            <!-- Lien vers ton site -->
            <p style="margin-top: 15px;">
                <a href="https://lexpertimmo.onrender.com" target="_blank" style="color: #007bff; font-weight: bold;">
                    Voir un exemple de site réalisé : lexpertimmo.onrender.com
                </a>
            </p>
        </div>

        <!-- Dépannage informatique -->
        <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h3 style="font-size: 22px; margin-bottom: 10px;">Dépannage informatique</h3>
            <p style="color: #555;">
                J’ai travaillé pendant une année dans une société de dépannage informatique
                (aujourd’hui disparue).  
                J’y ai acquis une solide expérience en diagnostic, réparation, assistance
                utilisateur et optimisation de matériel.
            </p>
        </div>

    </div>

@endsection
