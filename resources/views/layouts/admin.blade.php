<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            overflow-y: auto;
            z-index: 1040;
            transition: transform 0.25s ease;
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
        .topbar {
            display: none;
        }

        /* ===== Smartphone / tablette ===== */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .content {
                margin-left: 0;
                padding: 15px;
            }
            .content .container {
    max-width: 100%;
    padding-left: 0;
    padding-right: 0;
}
.content .form-control,
.content .btn {
    font-size: 16px; /* évite le zoom automatique d'iOS sur les champs */
}
pre {
    overflow-x: auto;
}
            .topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                background: #1e1e2d;
                color: white;
                padding: 12px 15px;
                position: sticky;
                top: 0;
                z-index: 1030;
            }
            .topbar button {
                background: none;
                border: none;
                color: white;
                font-size: 26px;
                line-height: 1;
            }
            .content h2 {
                font-size: 22px !important;
            }
            /* tableaux scrollables horizontalement */
            .table-responsive-auto {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

<!-- Barre du haut (mobile uniquement) -->
<div class="topbar">
    <strong>Admin Infortom</strong>
    <button type="button" onclick="document.querySelector('.sidebar').classList.toggle('open')">☰</button>
</div>

<div class="sidebar">
    <h4 class="text-center mb-4">Admin Infortom</h4>

    <a href="{{ route('admin.dashboard') }}">📊 Tableau de bord</a>
    <a href="{{ route('admin.devis.create') }}">📝 Créer un devis</a>
    <a href="{{ route('admin.devis.index') }}">📄 Liste des devis</a>
    <a href="{{ route('admin.messages.index') }}">✉️ Messages</a>
    <a href="{{ route('admin.paiements.index') }}">💳 Paiements</a>
    <a href="{{ route('admin.rendezvous.index') }}">📅 Rendez-vous</a>
    <a href="{{ route('admin.users.index') }}">👥 Utilisateurs</a>
    <a href="{{ route('admin.users.settings') }}">⚙️ Paramètres</a>
    <a href="{{ route('admin.service.config.form', 1) }}">🛠️ Configurations services</a>

    <form action="{{ route('logout') }}" method="POST" class="mt-4 mb-4 text-center">
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