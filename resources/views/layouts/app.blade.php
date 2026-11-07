<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Infortom Cannes - Dépannage informatique, serveurs AD et sites web')</title>
    <meta name="description" content="@yield('description', 'Infortom à Cannes : dépannage informatique, serveurs Active Directory, réseaux et création de sites web professionnels clé en main pour particuliers et auto-entrepreneurs.')">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <meta name="google-site-verification" content="LGvgF4dy0ULdL49WpW8ic6lZsEcseuuqnz23poSY6hE" />

    <link rel="canonical" href="https://infortom.fr{{ request()->getPathInfo() }}" />

    <!-- Open Graph (Facebook, Instagram, WhatsApp, LinkedIn) -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Infortom">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:url" content="https://infortom.fr{{ request()->getPathInfo() }}">
    <meta property="og:title" content="@yield('title', 'Infortom Cannes - Dépannage informatique, serveurs AD et sites web')">
    <meta property="og:description" content="@yield('description', 'Infortom à Cannes : dépannage informatique, serveurs Active Directory, réseaux et création de sites web professionnels clé en main pour particuliers et auto-entrepreneurs.')">
    <meta property="og:image" content="https://infortom.fr/images/og-infortom.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Infortom - dépannage informatique, serveurs et sites web à Cannes">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #ffffff;
            color: black;
        }

        /* HEADER */
        header {
            background: #0d0d0d;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #1f1f1f;
            position: relative;
            z-index: 10;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-logo {
            height: 55px;
        }

        .header-title {
            font-size: 22px;
            font-weight: bold;
            color: #6ec6ff;
        }

        /* NAVIGATION */
        nav {
            display: flex;
            gap: 25px;
        }

        nav a {
            color: #d0d0d0;
            text-decoration: none;
            font-size: 15px;
            font-weight: bold;
        }

        nav a:hover,
        nav a.active {
            color: #6ec6ff;
            text-decoration: underline;
        }

        /* MAIN */
        main {
            padding: 0;
            margin: 0;
            max-width: 100%;
        }

        /* RESPONSIVE SMARTPHONE */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                text-align: center;
                padding: 15px;
            }

            .header-left {
                flex-direction: column;
                gap: 8px;
            }

            .header-logo {
                height: 48px;
            }

            .header-title {
                font-size: 20px;
            }

            nav {
                margin-top: 12px;
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }

            nav a {
                font-size: 14px;
            }
        }

        @media (max-width: 420px) {
            nav {
                gap: 10px;
            }

            nav a {
                font-size: 13px;
            }

            .header-title {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

<header>
    <div class="header-left">
        <img src="{{ asset('images/infortom-logo.png') }}" class="header-logo" alt="Logo Infortom">
        <div class="header-title">infortom</div>
    </div>

    <nav>
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">ACCUEIL</a>
        <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">NOS SERVICES</a>
        <a href="{{ route('tarifs') }}" class="{{ request()->routeIs('tarifs') ? 'active' : '' }}">NOS TARIFS</a>
        <a href="{{ route('realisations') }}" class="{{ request()->routeIs('realisations') ? 'active' : '' }}">NOS RÉALISATIONS</a>
        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">CONTACT</a>
    </nav>
</header>

<main>
    @yield('content')
</main>

{{-- Bandeau de consentement cookies + chargement du pixel Meta (une seule fois, juste avant </body>) --}}
@include('partials.cookie-banner')

</body>
</html>