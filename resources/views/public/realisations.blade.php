@extends('layouts.app')

@section('title', 'Réalisations - Infortom | Création de sites web à Cannes pour auto-entrepreneurs')
@section('description', 'Découvrez les sites créés par Infortom à Cannes : devis en ligne, réservation, facturation et paiement sécurisé pour auto-entrepreneurs.')

@section('content')

<style>
    /* ==== HERO ==== */
    .hero-split { display:flex; align-items:center; background:linear-gradient(135deg, #f8f9ff 0%, #e2e8f0 100%); padding:45px; border-radius:12px; margin-top:20px; margin-bottom:20px; box-shadow:0 4px 15px rgba(0,0,0,0.05); }
    .hero-left { flex:1; }
    .hero-badge { display:inline-block; background:#1e3a8a; color:#fff; padding:6px 14px; font-size:13px; font-weight:700; border-radius:20px; margin-bottom:15px; text-transform:uppercase; letter-spacing:0.5px; }
    .hero-left h1 { font-size:32px; font-weight:800; color:#1e3a8a; margin-bottom:15px; line-height:1.2; }
    .hero-left p { font-size:16px; color:#333; margin-bottom:18px; line-height:1.5; }
    .hero-list { background:#fff; border-left:5px solid #2563eb; padding:18px; margin:20px 0; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.03); }
    .hero-list div { margin-bottom:10px; font-size:15px; font-weight:600; color:#1f2937; }
    .hero-list div:last-child { margin-bottom:0; }
    .hero-phone { font-size:22px; font-weight:700; color:#1e3a8a; margin:15px 0; }
    .btn-blue { background:#1e3a8a; color:#fff; padding:12px 22px; font-size:16px; font-weight:700; text-decoration:none; display:inline-block; border-radius:8px; margin-bottom:12px; }
    .btn-outline { background:#fff; color:#1e3a8a; border:2px solid #1e3a8a; padding:12px 22px; font-size:16px; font-weight:700; text-decoration:none; display:inline-block; border-radius:8px; }

    /* ===== Blocs communs ===== */
    .real-grey, .real-white, .real-engagements { width:100%; padding:60px 40px; text-align:left; box-sizing:border-box; }
    .real-grey { background:#f2f2f2; }
    .real-white { background:#ffffff; }
    .real-engagements { background:#f2f2f2; }

    .real-grey h2 { font-size:34px; font-weight:800; color:#1e3a8a; margin-bottom:20px; }
    .real-white h2, .real-engagements h2 { font-size:30px; font-weight:800; color:#1e3a8a; margin-bottom:20px; }
    .real-grey p, .real-white p, .real-engagements .intro { font-size:17px; color:#333; max-width:900px; line-height:1.6; }
    .real-grey .tagline { font-size:20px; font-weight:700; color:#1e3a8a; margin-bottom:15px; }
    .real-white p a, .real-grey p a { color:#1e3a8a; font-weight:700; text-decoration:underline; }

    /* ===== Engagements ===== */
    .engagement-cards, .project-cards { display:flex; flex-wrap:wrap; gap:25px; margin-top:35px; }
    .engagement-card, .project-card { flex:1 1 280px; max-width:420px; border-radius:12px; padding:28px; box-sizing:border-box; border-left:5px solid #1e3a8a; }
    .engagement-card { background:#ffffff; }
    .project-card { background:#f2f2f2; }
    .engagement-card h3, .project-card h3 { font-size:22px; font-weight:800; color:#1e3a8a; margin:0 0 10px 0; }
    .engagement-card p { font-size:16px; color:#333; line-height:1.6; margin:0; }
    .project-card .project-desc { font-size:16px; color:#333; line-height:1.6; margin:0 0 20px 0; }
    .project-card .project-btn { display:inline-block; background:#1e3a8a; color:white; padding:12px 24px; border-radius:8px; text-decoration:none; font-size:16px; font-weight:600; }
    .project-card .project-btn:hover { background:#16296b; }

    /* ===== Images ===== */
    .real-grid { width:100%; background:#ffffff; padding:40px 20px; display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:20px; box-sizing:border-box; }
    .real-grid img { width:100%; height:230px; object-fit:cover; border-radius:8px; }

    /* ===== CTA bleu ===== */
    .cta-blue-full { width:100%; background:#1e3a8a; padding:60px 40px; text-align:center; color:white; box-sizing:border-box; }
    .cta-blue-full h2 { font-size:34px; font-weight:800; margin-bottom:20px; color:white; }
    .cta-blue-full p { font-size:17px; max-width:900px; margin:0 auto 35px auto; line-height:1.6; color:#f8f8f8; }
    .cta-blue-full .cta-white-btn { background:white; color:black; padding:14px 30px; border-radius:8px; text-decoration:none; font-size:16px; font-weight:600; display:inline-block; }
    .cta-blue-full .cta-buttons { display:flex; flex-wrap:wrap; justify-content:center; gap:15px; }

    /* ===== Mini footer ===== */
    .mini-footer { width:100%; background:#000; padding:12px 25px; color:#888; font-size:14px; text-align:left; display:flex; flex-wrap:wrap; justify-content:space-between; gap:10px; box-sizing:border-box; }
    .mini-footer-links { display:flex; flex-wrap:wrap; gap:18px; }
    .mini-footer-links a { color:#bbb; text-decoration:none; }
    .mini-footer-links a:hover { color:#fff; text-decoration:underline; }

    /* ===== Mobile ===== */
    @media (max-width:600px) {
        .hero-split { flex-direction:column; text-align:center; padding:25px; }
        .hero-left h1 { font-size:26px; }
        .btn-blue, .btn-outline { width:90%; box-sizing:border-box; }
        .real-white, .real-grey, .real-engagements { padding:40px 20px; }
        .project-card, .engagement-card { max-width:100%; }
        .project-card .project-btn { display:block; text-align:center; }
        .cta-blue-full h2 { font-size:26px; }
        .cta-blue-full p { font-size:15px; }
        .cta-blue-full .cta-white-btn { width:90%; box-sizing:border-box; }
    }
</style>

<!-- ==== HERO ==== -->
<div class="hero-split">
    <div class="hero-left">
        <span class="hero-badge">🌐 Sites déjà en ligne</span>
        <h1>Voyez ce que nous avons créé pour d'autres indépendants.</h1>

        <p>
            Infortom, à Cannes, conçoit des sites clés en main pour les auto‑entrepreneurs.
            Parcourez nos réalisations et jugez par vous‑même.
        </p>

        <div class="hero-list">
            <div>✅ Devis en ligne et prise de contact simplifiée</div>
            <div>✅ Réservation et paiement sécurisé</div>
            <div>✅ Facturation automatique par e‑mail</div>
            <div>✅ Design moderne adapté à votre métier</div>
        </div>

        <p class="hero-phone">📞 07 43 33 44 24</p>

        <a href="{{ route('contact') }}" class="btn-blue">💬 Demander un devis gratuit (réponse sous 48h)</a>
        <br>
        <a href="tel:0743334424" class="btn-outline">📞 Appeler maintenant</a>
    </div>
</div>

<!-- ==== PRÉSENTATION (gris) ==== -->
<div class="real-grey">
    <h2>L'exception au quotidien</h2>

    <p class="tagline">Infortom, à Cannes : des sites web clés en main pour les auto‑entrepreneurs.</p>

    <p>
        C'est ici que commence notre aventure. Chez Infortom, nous concevons des sites internet modernes
        pour les auto‑entrepreneurs qui souhaitent se faire connaître rapidement. De la prise de rendez‑vous
        aux paiements en ligne sécurisés, en passant par l'envoi automatique de devis et factures par e‑mail,
        chaque projet allie harmonie visuelle, simplicité d'utilisation et tarifs accessibles.
    </p>
</div>

<!-- ==== NOS ENGAGEMENTS ==== -->
<div class="real-engagements">
    <h2>Nos engagements : qualité et service impeccable</h2>

    <p class="intro">
        Rejoignez‑nous pour grandir et atteindre des sommets, ensemble. Nous sommes heureux que vous soyez ici
        pour faire partie de notre histoire.
    </p>

    <div class="engagement-cards">
        <div class="engagement-card">
            <h3>Adaptabilité</h3>
            <p>Nous nous adaptons à vos besoins et à votre budget, pour une solution qui vous ressemble vraiment.</p>
        </div>

        <div class="engagement-card">
            <h3>Excellence</h3>
            <p>Nous sommes fiers de notre engagement envers l'excellence dans tous les aspects de notre service, à chaque étape de votre projet.</p>
        </div>

        <div class="engagement-card">
            <h3>Votre réussite</h3>
            <p>Découvrez ce que nous pouvons vous apporter et voyez comment nous vous aidons à atteindre vos objectifs.</p>
        </div>
    </div>
</div>

<!-- ==== PROJETS ==== -->
<div class="real-white">
    <h2>Projets récents créés pour nos clients</h2>

    <p>
        Découvrez nos réalisations phares telles que
        <a href="https://careandnet.onrender.com" target="_blank" rel="noopener noreferrer">Careandnet</a>
        et
        <a href="https://thomaservice.onrender.com" target="_blank" rel="noopener noreferrer">Thomaservice</a>.
        Pour chacun de ces professionnels, nous avons mis en place une interface élégante et intuitive,
        une communication directe par e‑mail, la réservation en ligne ainsi qu'un système automatisé
        de facturation et de paiement.
    </p>

    <div class="project-cards">
        <div class="project-card">
            <h3>Careandnet</h3>
            <p class="project-desc">Entreprise de nettoyage à Cannes et dans les Alpes‑Maritimes : devis en ligne et prise de contact simplifiée.</p>
            <a href="https://careandnet.onrender.com" target="_blank" rel="noopener noreferrer" class="project-btn">Visiter le site</a>
        </div>

        <div class="project-card">
            <h3>Thomaservice</h3>
            <p class="project-desc">Accompagnement, autonomie et bien‑être au Cannet : présentation des services, tarifs et formulaire de contact.</p>
            <a href="https://thomaservice.onrender.com" target="_blank" rel="noopener noreferrer" class="project-btn">Visiter le site</a>
        </div>
    </div>
</div>

<!-- ==== IMAGES ==== -->
<div class="real-grid">
    <img src="{{ asset('images/1134192.webp') }}" alt="">
    <img src="{{ asset('images/2011929.webp') }}" alt="">
    <img src="{{ asset('images/2332611.webp') }}" alt="">
    <img src="{{ asset('images/6434779.webp') }}" alt="">
    <img src="{{ asset('images/12149155.webp') }}" alt="">
    <img src="{{ asset('images/29430138.jpg') }}" alt="">
    <img src="{{ asset('images/28625421.jpg') }}" alt="">
    <img src="{{ asset('images/5623083.webp') }}" alt="">
</div>

<!-- ==== CTA BLEU ==== -->
<div class="cta-blue-full">
    <h2>Prêt à lancer votre site internet ?</h2>

    <p>
        Vous lancez votre activité ou souhaitez donner un nouvel élan à votre présence en ligne ?
        Contactez Infortom dès aujourd'hui par téléphone ou via notre formulaire pour échanger sur vos besoins
        et obtenir une solution adaptée à votre budget.
    </p>

    <div class="cta-buttons">
        <a href="tel:0743334424" class="cta-white-btn">📞 Appeler maintenant</a>
        <a href="{{ route('contact') }}" class="cta-white-btn">Nous contacter</a>
        <a href="{{ route('services') }}" class="cta-white-btn">Découvrir nos services</a>
    </div>
</div>

<!-- ==== PETITE BARRE NOIRE ==== -->
<div class="mini-footer">
    <span>© 2026 infortom</span>
    <nav class="mini-footer-links">
        <a href="{{ route('home') }}">Accueil</a>
        <a href="{{ route('services') }}">Services</a>
        <a href="{{ route('realisations') }}">Réalisations</a>
        <a href="{{ route('contact') }}">Contact</a>
    </nav>
</div>

@endsection