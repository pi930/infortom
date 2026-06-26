@extends('layouts.app')

@section('content')

<style>
    .home-background {
    background-image: url('{{ asset('images/home-background.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 40px 0;
    position: relative;
}

/* Voile sombre pour lisibilité */
.home-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.35); /* Ajuste l’opacité si tu veux */
    z-index: 1;
}

/* Contenu au-dessus du voile */
.home-background > .container {
    position: relative;
    z-index: 2;
}

    /* --- Style global compacté --- */
    .compact-section {
        padding: 35px 0 !important;
    }

    .compact-title {
        margin-bottom: 20px !important;
    }

    .compact-text {
        margin-bottom: 20px !important;
    }

    .btn-main {
        padding: 10px 18px !important;
        margin: 8px !important;
        font-size: 16px !important;
        border-radius: 6px;
        display: inline-block;
        white-space: normal;
    }

    /* --- Responsive smartphone --- */
    @media (max-width: 600px) {
        

        .hero {
            padding: 30px 10px !important;
        }

        .hero h1 {
            font-size: 26px !important;
            margin-bottom: 12px !important;
        }

        .hero p {
            font-size: 15px !important;
            margin-bottom: 18px !important;
        }

        .top-buttons a {
            display: block;
            width: 90%;
            margin: 8px auto !important;
        }

        .services {
            padding: 30px 10px !important;
        }

        .services h2 {
            font-size: 24px !important;
            margin-bottom: 20px !important;
        }

        .service-card {
            width: 100% !important;
            margin-bottom: 15px !important;
        }
    }
</style>


<div class="top-buttons" style="text-align: center; margin-top: 20px;">

    @guest
        <a href="{{ route('login') }}"
           class="btn-main"
           style="background: #3f51b5; color: white; text-decoration: none;">
            Connexion
        </a>

        <a href="{{ route('register') }}"
           class="btn-main"
           style="background: #4caf50; color: white; text-decoration: none;">
            Inscription
        </a>
    @endguest

    @auth
        <a href="{{ route('user.dashboard') }}"
           class="btn-main"
           style="background: #ff9800; color: white; text-decoration: none;">
            Tableau de bord
        </a>
    @endauth

</div>


<section class="hero compact-section home-background" style="margin-top: 10px;">
    <div class="container" style="max-width: 900px; margin: auto; text-align: center;">

        <h1 class="compact-title" style="font-size: 36px; font-weight: bold;">
            Bienvenue chez Infortom
        </h1>

        <p class="compact-text" style="font-size: 17px; color: #555;">
            Votre partenaire informatique pour le dépannage, l’assistance, le développement web
            et les solutions numériques adaptées à vos besoins.
        </p>

        @auth
            <a href="{{ route('contact') }}"
               class="btn-main"
               style="background: #007bff; color: white; text-decoration: none;">
                Demander un devis
            </a>
        @else
            <a href="{{ route('login') }}"
               class="btn-main"
               style="background: #ff5722; color: white; text-decoration: none;">
                Connectez-vous pour demander un devis
            </a>
        @endauth

    </div>
</section>


<section class="services compact-section">
    <div class="container" style="max-width: 1000px; margin: auto;">
        <h2 class="compact-title" style="text-align: center; font-size: 28px;">
            Mes services
        </h2>

        <div style="display: flex; flex-wrap: wrap; gap: 15px; justify-content: center;">

            <div class="service-card"
                 style="width: 300px; background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <h3 style="font-size: 20px; margin-bottom: 8px;">Dépannage informatique</h3>
                <p style="color: #555; font-size: 15px;">Intervention rapide pour résoudre vos problèmes matériels et logiciels.</p>
            </div>

        </div>
    </div>
</section>

@endsection
