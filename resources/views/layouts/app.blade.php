<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infortom</title>

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

        /* ULTRA SMALL DEVICES (iPhone SE, Galaxy Mini) */
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

</body>
</html>

