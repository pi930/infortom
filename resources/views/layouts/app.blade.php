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
            background: #3f51b5; /* Indigo */
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
            font-weight: bold;
        }
        .logo-wrapper {
    background: white;          /* contour blanc */
    padding: 6px;               /* espace entre logo et contour */
    border-radius: 6px;         /* angles doux */
    margin-right: 20px;         /* espace avec le menu */
    display: flex;
    align-items: center;
    justify-content: center;
}


        nav a:hover {
            text-decoration: underline;
        }

        /* Style du bouton logout */
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

        /* Contenu principal */
        main {
            padding: 40px;
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


<main>
    @yield('content')
</main>

</body>
</html>

