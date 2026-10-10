<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Infortom - Création de sites web pour auto-entrepreneurs')</title>
    <meta name="google-site-verification" content="cwL-kSfZ-1odv-tdAU4prfYn0K07rslVkkCSBswSik4" />
<meta name="description" content="@yield('description', 'Infortom à Cannes crée des sites professionnels clé en main pour auto-entrepreneurs : devis en ligne, paiement sécurisé, gestion automatisée.')">

<!-- Open Graph (Facebook, Instagram, WhatsApp, LinkedIn) -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="Infortom">
<meta property="og:locale" content="fr_FR">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="@yield('title', 'Infortom - Création de sites web pour auto-entrepreneurs')">
<meta property="og:description" content="@yield('description', 'Des sites professionnels clé en main pour auto-entrepreneurs, à Cannes.')">
<meta property="og:image" content="{{ asset('images/og-infortom.jpg') }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="Infortom - création de sites web">

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

        /* ==== BANDEAU COOKIES ==== */
        #cookie-banner {
            display: none;
            position: fixed;
            left: 20px;
            right: 20px;
            bottom: 20px;
            max-width: 760px;
            margin: 0 auto;
            background: white;
            border: 2px solid #1e3a8a;
            border-radius: 12px;
            padding: 22px 25px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.25);
            z-index: 9999;
        }

        #cookie-banner h3 {
            margin: 0 0 8px 0;
            font-size: 18px;
            font-weight: 800;
            color: #1e3a8a;
        }

        #cookie-banner p {
            margin: 0 0 16px 0;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
        }

        #cookie-banner p a {
            color: #1e3a8a;
            font-weight: 600;
        }

        .cookie-actions {
            display: flex;
            gap: 12px;
        }

        .cookie-btn {
            flex: 1;
            padding: 12px 18px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            border: 2px solid #1e3a8a;
        }

        .cookie-btn-accept {
            background: #1e3a8a;
            color: white;
        }

        .cookie-btn-refuse {
            background: white;
            color: #1e3a8a;
        }

        @media (max-width: 600px) {
            #cookie-banner {
                left: 10px;
                right: 10px;
                bottom: 10px;
                padding: 18px;
            }

            .cookie-actions {
                flex-direction: column;
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

<!-- ==== BANDEAU DE CONSENTEMENT COOKIES ==== -->
<div id="cookie-banner" role="dialog" aria-live="polite" aria-label="Gestion des cookies">
    <h3>Vos préférences de cookies</h3>
    <p>
        Nous utilisons le pixel Meta (Facebook / Instagram) pour mesurer l'efficacité de nos publicités.
        Il n'est activé qu'avec votre accord. Vous pouvez accepter ou refuser, et changer d'avis à tout moment.
        <a href="{{ route('confidentialite') }}">En savoir plus</a>
    </p>
    <div class="cookie-actions">
        <button type="button" class="cookie-btn cookie-btn-refuse" onclick="refuseCookies()">Tout refuser</button>
        <button type="button" class="cookie-btn cookie-btn-accept" onclick="acceptCookies()">Tout accepter</button>
    </div>
</div>

<script>
    const META_PIXEL_ID = '1027697580327686';
    const CONSENT_KEY = 'infortom_cookie_consent';
    const CONSENT_DURATION_DAYS = 180; // 6 mois, puis le bandeau réapparaît

    function getConsent() {
        try {
            const raw = localStorage.getItem(CONSENT_KEY);
            if (!raw) return null;
            const data = JSON.parse(raw);
            const ageDays = (Date.now() - data.date) / (1000 * 60 * 60 * 24);
            if (ageDays > CONSENT_DURATION_DAYS) {
                localStorage.removeItem(CONSENT_KEY);
                return null;
            }
            return data.value;
        } catch (e) {
            return null;
        }
    }

    function setConsent(value) {
        try {
            localStorage.setItem(CONSENT_KEY, JSON.stringify({ value: value, date: Date.now() }));
        } catch (e) {}
    }

    function loadMetaPixel() {
        if (window.fbq) return;
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', META_PIXEL_ID);
        fbq('track', 'PageView');
    }

    function showCookieBanner() {
        document.getElementById('cookie-banner').style.display = 'block';
    }

    function hideCookieBanner() {
        document.getElementById('cookie-banner').style.display = 'none';
    }

    function acceptCookies() {
        setConsent('accepted');
        hideCookieBanner();
        loadMetaPixel();
    }

    function refuseCookies() {
        const wasAccepted = (getConsent() === 'accepted') || !!window.fbq;
        setConsent('refused');
        hideCookieBanner();

        if (wasAccepted) {
            // Supprime les cookies Meta et recharge la page pour décharger le pixel
            document.cookie = '_fbp=; Max-Age=0; path=/';
            document.cookie = '_fbc=; Max-Age=0; path=/';
            window.location.reload();
        }
    }

    // Permet de rouvrir le bandeau depuis un lien (« Gérer les cookies »)
    function openCookieSettings() {
        showCookieBanner();
    }

    document.addEventListener('DOMContentLoaded', function () {
        const consent = getConsent();
        if (consent === 'accepted') {
            loadMetaPixel();
        } else if (consent === null) {
            showCookieBanner();
        }
    });
</script>

</body>
</html>