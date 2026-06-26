<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infortom</title>

    <style>
        .header-logo {
            height: 55px;
            margin-right: 15px;
            vertical-align: middle;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
        }

        /* Bandeau bleu indigo */
        header {
            background: #3f51b5;
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .logo-wrapper {
            background: white;
            padding: 6px;
            border-radius: 6px;
            margin-right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout-btn {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            margin-left: 20px;
            cursor: pointer;
        }

        .logout-btn:hover {
            text-decoration: underline;
        }

        /* 🌌 Fond global */
        .global-background {
            background-image: url('{{ asset('images/home-background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            min-height: 100vh;
            padding: 40px 0;
        }

        /* Voile sombre */
        .global-background::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.25);
            z-index: 1;
        }

        /* Contenu au-dessus */
        .global-background > main {
            position: relative;
            z-index: 2;
        }

        main {
            max-width: 1100px;
            margin: auto;
        }
    </style>
</head>

<body>

<header>
    <div style="display: flex; align-items: center;">
        <div class="logo-wrapper">
            <img src="{{ asset('images/infortom-logo.png') }}"
                 alt="Logo Infortom"
                 class="header-logo">
        </div>
    </div>

    <nav>
        <a href="{{ route('user.devis.index') }}">📄 Devis</a>
        <a href="{{ route('user.rendezvous.index') }}">📅 Rendez-vous</a>
        <a href="{{ route('user.messages.index') }}">💬 Messages</a>

        <a href="{{ route('home') }}">Accueil</a>
        <a href="{{ route('services') }}">Services</a>
        <a href="{{ route('competences') }}">Compétences</a>
        <a href="{{ route('contact') }}">Contact</a>

        @auth
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="logout-btn">Déconnexion</button>
        </form>
        @endauth
    </nav>
</header>

<div class="global-background">
    <main>
        @yield('content')
    </main>
</div>

</body>
</html>
