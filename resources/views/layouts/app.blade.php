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
    <h1>Infortom</h1>

    <nav>
        <a href="{{ route('panier.show') }}">
    Panier 
    @if(session('panier_total'))
        ({{ session('panier_total') }} €)
    @endif
</a>

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

