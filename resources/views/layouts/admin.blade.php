<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #1e1e2d;
            color: white;
            padding-top: 30px;
        }
        .sidebar a {
            color: #cfd2da;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            font-size: 16px;
        }
        .sidebar a:hover {
            background: #27293d;
            color: white;
        }
        .content {
            margin-left: 260px;
            padding: 30px;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h4 class="text-center mb-4">Admin Infortom</h4>

    <a href="{{ route('admin.dashboard') }}">📊 Tableau de bord</a>
    <a href="{{ route('admin.devis.create') }}">📝 Créer un devis</a>
    <a href="{{ route('admin.devis.index') }}">📄 Liste des devis</a>
    <a href="{{ route('admin.messages.index') }}">✉️ Messages</a>
    <a href="{{ route('admin.paiements.index') }}">💳 Paiements</a>
    <a href="{{ route('admin.rendezvous.index') }}">📅 Rendez-vous</a>

    <!-- 🔥 Nouveau lien Utilisateurs -->
    <a href="{{ route('admin.users.index') }}">👥 Utilisateurs</a>

    <a href="{{ route('admin.users.settings') }}">⚙️ Paramètres</a>

    <form action="{{ route('logout') }}" method="POST" class="mt-4 text-center">
        @csrf
        <button class="btn btn-danger w-75">
            🔓 Déconnexion
        </button>
    </form>
</div>


    <div class="content">
        <h2 class="mb-4">@yield('title')</h2>

        @yield('content')
    </div>

</body>
</html>
