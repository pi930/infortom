@extends('layouts.app')

@section('content')

    <h2 style="text-align: center; font-size: 32px; margin-bottom: 40px;">
        Mes Compétences
    </h2>

    <div style="max-width: 900px; margin: auto;">

        <!-- Création de sites web -->
        <div style="background: white; padding: 25px; border-radius: 8px; 
                    box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 25px;">
            <h3 style="font-size: 22px; margin-bottom: 10px;">Création de sites web</h3>
            <p style="color: #555;">
                J’ai réalisé quatre sites web complets, incluant la conception, le développement,
                l’intégration et la mise en ligne.  
                Ces projets m’ont permis de maîtriser la structure d’un site moderne, la gestion
                des pages, l’ergonomie et l’optimisation.
            </p>

            <!-- LEXPERTIMMO -->
            <div style="display:flex; align-items:center; gap:15px; margin-top:20px;">
                <img src="/images/photo3.jpg" alt="LEXPERTIMMO" 
                     style="width:120px; height:auto; border-radius:6px;">
                <a href="https://lexpertimmo.onrender.com" target="_blank" 
                   style="color:#007bff; font-weight:bold;">
                    https://lexpertimmo.onrender.com
                </a>
            </div>

            <!-- ChampsCamelBonDoux -->
            <div style="display:flex; align-items:center; gap:15px; margin-top:20px;">
                <img src="/images/photo1.jpg" alt="ChampsCamelBonDoux" 
                     style="width:120px; height:auto; border-radius:6px;">
                <a href="https://champscameibondoux-2.onrender.com" target="_blank" 
                   style="color:#007bff; font-weight:bold;">
                    https://champscameibondoux-2.onrender.com
                </a>
            </div>

            <!-- Thomaservice -->
            <div style="display:flex; align-items:center; gap:15px; margin-top:20px;">
                <img src="/images/photo2.jpg" alt="Thomaservice" 
                     style="width:120px; height:auto; border-radius:6px;">
                <a href="https://thomaservice.onrender.com" target="_blank" 
                   style="color:#007bff; font-weight:bold;">
                    https://thomaservice.onrender.com
                </a>
            </div>

            <!-- Infortom -->
            <div style="display:flex; align-items:center; gap:15px; margin-top:20px;">
                <a href="https://infortom-1.onrender.com" target="_blank" 
                   style="color:#007bff; font-weight:bold;">
                    https://infortom-1.onrender.com
                </a>
            </div>

        </div>

        <!-- Dépannage informatique -->
        <div style="background: white; padding: 25px; border-radius: 8px; 
                    box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 25px;">
            <h3 style="font-size: 22px; margin-bottom: 10px;">Dépannage informatique</h3>
            <p style="color: #555;">
                J’ai travaillé pendant une année dans une société de dépannage informatique.
                J’y ai acquis une solide expérience en diagnostic, réparation, assistance
                utilisateur et optimisation de matériel.
            </p>
        </div>

        <!-- Réalisation de serveur Active Directory -->
        <div style="background: white; padding: 25px; border-radius: 8px; 
                    box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 25px;">
            <h3 style="font-size: 22px; margin-bottom: 10px;">Réalisation de serveur Active Directory</h3>
            <p style="color: #555;">
                Mise en place complète d’un environnement Active Directory professionnel :
                installation du rôle AD DS, configuration DNS, création d’unités d’organisation (OU),
                gestion des utilisateurs et groupes, jonction de postes au domaine, déploiement de
                stratégies GPO et sécurisation du serveur.
            </p>
        </div>

    </div>

    <!-- Bandeau noir -->
    <footer style="background:black; color:white; text-align:center; padding:20px; margin-top:50px;">
        <a href="/support" style="color:white; text-decoration:underline; margin-right:20px;">
            Contactez le support
        </a>

        <a href="/confidentialite" style="color:white; text-decoration:underline; margin-right:20px;">
            Déclaration de confidentialité
        </a>

        <a href="/mentions-legales" style="color:white; text-decoration:underline;">
            Informations légales
        </a>
    </footer>

@endsection

