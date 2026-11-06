@extends('layouts.app')

@section('title', 'Dépannage informatique à Cannes - Infortom | Serveurs AD, nettoyage, réseaux')
@section('description', 'Dépannage informatique, nettoyage virus, serveurs Active Directory, réseaux et sites web à Cannes. Intervention rapide, devis gratuit : 07 43 33 44 24.')

@section('content')

<style>
    /* ==== HERO ==== */
    .hero-split { display:flex; align-items:center; background:linear-gradient(135deg, #f8f9ff 0%, #e2e8f0 100%); padding:45px; border-radius:12px; margin-top:20px; box-shadow:0 4px 15px rgba(0,0,0,0.05); }
    .hero-left { flex:1; }
    .hero-badge { display:inline-block; background:#1e3a8a; color:#fff; padding:6px 14px; font-size:13px; font-weight:700; border-radius:20px; margin-bottom:15px; text-transform:uppercase; letter-spacing:0.5px; }
    .hero-left h1 { font-size:32px; font-weight:800; color:#1e3a8a; margin-bottom:15px; line-height:1.2; }
    .hero-left p { font-size:16px; color:#333; margin-bottom:18px; line-height:1.5; }
    .hero-list { background:#fff; border-left:5px solid #2563eb; padding:18px; margin:20px 0; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.03); }
    .hero-list div { margin-bottom:10px; font-size:15px; font-weight:600; color:#1f2937; }
    .hero-list div:last-child { margin-bottom:0; }
    .hero-phone { font-size:22px; font-weight:700; color:#1e3a8a; margin:15px 0; }
    .btn-outline { background:#fff; color:#1e3a8a; border:2px solid #1e3a8a; padding:12px 22px; font-size:16px; font-weight:700; text-decoration:none; display:inline-block; border-radius:8px; }

    /* ==== STYLES COMMUNS ==== */
    .btn-blue { background:#1e3a8a; color:#fff; padding:14px 30px; border-radius:8px; text-decoration:none; font-size:16px; font-weight:600; display:inline-block; margin-top:20px; text-align:center; }
    .cta-white { background:#fff; color:#000; padding:14px 30px; border-radius:8px; text-decoration:none; font-size:16px; font-weight:600; display:inline-block; }
    .section-title { font-size:32px; font-weight:800; color:#1e3a8a; margin-bottom:10px; }
    .section-subtitle { font-size:16px; color:#333; margin-bottom:40px; max-width:900px; line-height:1.6; }

    /* ==== BLOC BLEU ==== */
    .full-blue { width:100%; background:#1e3a8a; color:#fff; padding:60px 30px; text-align:center; margin-top:20px; }
    .full-blue h2 { font-size:34px; font-weight:800; margin-bottom:20px; color:#fff; }
    .full-blue p { font-size:17px; max-width:900px; margin:0 auto 20px auto; line-height:1.6; }

    /* ==== BLOCS BLANCS ==== */
    .block-white { width:100%; background:#fff; padding:50px 40px; }
    .grid { display:flex; justify-content:space-between; gap:30px; flex-wrap:wrap; }
    .grid-item { flex:1 1 220px; text-align:left; }
    .grid-item img { width:100%; border-radius:8px; margin-bottom:15px; }
    .grid-item .icon { font-size:40px; margin-bottom:10px; }
    .grid-item h3 { font-size:22px; font-weight:700; color:#1e3a8a; margin-bottom:8px; }
    .grid-item p { font-size:15px; color:#333; line-height:1.5; margin-bottom:20px; }
    .card { background:#f8f9ff; padding:25px; border-radius:12px; }
    .center { text-align:center; margin-top:20px; }

    /* ==== BLOC GRIS ==== */
    .bloc-gris-full { width:100%; background:#f2f2f2; padding:60px 30px; text-align:center; }
    .bloc-gris-full h2 { font-size:32px; font-weight:800; color:#1e3a8a; margin-bottom:20px; }
    .bloc-gris-full p { font-size:17px; color:#333; max-width:900px; margin:0 auto; line-height:1.6; }

    /* ==== IMAGE + TEXTE ==== */
    .double-row { display:flex; align-items:center; justify-content:space-between; gap:40px; margin-bottom:60px; }
    .double-row img { width:100%; max-width:450px; border-radius:10px; }
    .double-text { flex:1; text-align:left; }
    .double-text h2 { font-size:32px; font-weight:800; color:#1e3a8a; margin-bottom:15px; }
    .double-text p { font-size:17px; color:#333; line-height:1.6; max-width:600px; margin-bottom:20px; }

    /* ==== MINI FOOTER ==== */
    .mini-footer { width:100%; background:#000; padding:12px 25px; color:#888; font-size:14px; text-align:left; }

    /* ==== RESPONSIVE ==== */
    @media (max-width:600px) {
        .hero-split { flex-direction:column; text-align:center; padding:25px; }
        .hero-left h1 { font-size:26px; }
        .hero-left p { font-size:15px; }
        .btn-outline { width:90%; box-sizing:border-box; }
        .full-blue h2, .section-title, .bloc-gris-full h2, .double-text h2 { font-size:26px; }
        .full-blue p, .bloc-gris-full p, .double-text p { font-size:15px; }
        .full-blue { padding:40px 20px; }
        .block-white { padding:35px 20px; }
        .btn-blue, .cta-white { width:90%; box-sizing:border-box; }
        .double-row { flex-direction:column; text-align:center; }
        .double-text { text-align:center; }
        .double-row img { max-width:100%; }
    }
</style>

<!-- ==== HERO ==== -->
<div class="hero-split">
    <div class="hero-left">
        <span class="hero-badge">🛠️ Intervention rapide à Cannes</span>
        <h1>Une panne ? Diagnostic clair, sans mauvaise surprise.</h1>

        <p>
            Ordinateur lent, virus, serveur à installer ou réseau en panne : Infortom intervient à Cannes
            et dans les environs pour particuliers et professionnels.
        </p>

        <div class="hero-list">
            <div>✅ Dépannage matériel et diagnostic complet</div>
            <div>✅ Nettoyage virus, malwares et logiciels espions</div>
            <div>✅ Serveurs Active Directory sur mesure</div>
            <div>✅ Réseaux et forfaits de maintenance</div>
        </div>

        <p class="hero-phone">📞 07 43 33 44 24</p>

        <a href="tel:0743334424" class="btn-blue">📞 Appeler maintenant</a>
        <br>
        <a href="{{ route('contact') }}" class="btn-outline">💬 Demander un devis gratuit</a>
        <br><br>
        <small style="color:#555;">Basé à Cannes • Particuliers et professionnels</small>
    </div>
</div>

<!-- ==== BLOC BLEU : INTRO ==== -->
<div class="full-blue">
    <h2>Dépannage informatique, serveurs et solutions web pour votre activité</h2>

    <p>
        Chez Infortom, nous intervenons rapidement pour réparer vos équipements, sécuriser vos systèmes
        et déployer vos serveurs Active Directory sur mesure.
    </p>
    <p>
        Nous accompagnons aussi les nouveaux auto‑entrepreneurs avec des sites web harmonieux
        et des outils automatiques intégrés : emails, devis, paiements et factures professionnelles
        à des tarifs accessibles, ainsi qu'un accompagnement publicitaire sur les réseaux sociaux
        avec des campagnes personnalisées adaptées à votre budget.
    </p>

    <a href="{{ route('tarifs') }}" class="cta-white">Découvrez nos tarifs</a>
</div>

<!-- ==== PRESTATIONS INFORMATIQUES ==== -->
<div class="block-white">
    <h2 class="section-title">Prestations de dépannage et d'infrastructure</h2>
    <p class="section-subtitle">
        Que vous soyez un particulier ou un professionnel, nous mettons notre expertise technique à votre service.
        Notre approche : comprendre vos besoins et vous apporter des solutions efficaces, pratiques et durables.
    </p>

    <div class="grid">
        <div class="grid-item card">
            <div class="icon">🛠️</div>
            <h3>Dépannage matériel</h3>
            <p>Diagnostic complet, remplacement de composants défectueux et optimisation des performances de vos ordinateurs fixes et portables.</p>
        </div>
        <div class="grid-item card">
            <div class="icon">🛡️</div>
            <h3>Nettoyage système</h3>
            <p>Éradication de virus, malwares et logiciels espions pour restaurer la réactivité et la stabilité de votre système d'exploitation.</p>
        </div>
        <div class="grid-item card">
            <div class="icon">🖥️</div>
            <h3>Serveurs Active Directory</h3>
            <p>Conception, installation et configuration complète de serveurs Windows AD pour centraliser la gestion de vos utilisateurs et droits d'accès.</p>
        </div>
        <div class="grid-item card">
            <div class="icon">🌐</div>
            <h3>Réseaux et maintenance</h3>
            <p>Installation de réseaux locaux, sécurisation des accès et forfaits de maintenance régulière pour prévenir les pannes critiques.</p>
        </div>
    </div>

    <div class="center">
        <a href="{{ route('tarifs') }}" class="btn-blue">Voir nos tarifs et forfaits</a>
    </div>
</div>

<!-- ==== FORMULES WEB ==== -->
<div class="block-white" style="background:#f8f9ff;">
    <h2 class="section-title">Nos formules et outils web clés</h2>
    <p class="section-subtitle">
        Chaque offre est pensée pour simplifier votre quotidien professionnel dès le lancement de votre entreprise.
    </p>

    <div class="grid">
        <div class="grid-item">
            <img src="{{ asset('images/3184458.webp') }}" alt="Site vitrine harmonieux">
            <h3>Site vitrine harmonieux</h3>
            <p>
                Une présence en ligne soignée et percutante pour présenter vos prestations et attirer vos premiers clients.
                Votre visibilité est renforcée grâce à un accompagnement publicitaire sur les réseaux sociaux,
                permettant de toucher rapidement les personnes qui recherchent vos services — avec des offres ajustées à vos besoins.
            </p>
        </div>

        <div class="grid-item">
            <img src="{{ asset('images/4841691.webp') }}" alt="Gestion et facturation">
            <h3>Gestion et facturation</h3>
            <p>Générez facilement des devis et envoyez automatiquement des factures professionnelles après chaque paiement sécurisé.</p>
        </div>

        <div class="grid-item">
            <img src="{{ asset('images/7439135.webp') }}" alt="Communication automatisée">
            <h3>Communication automatisée</h3>
            <p>Recevez et traitez vos messages facilement avec envoi d'emails automatiques configurés pour rassurer vos prospects.</p>
        </div>
    </div>

    <div class="center">
        <a href="{{ route('tarifs') }}" class="btn-blue">Consulter nos tarifs</a>
    </div>
</div>

<!-- ==== BLOC GRIS ==== -->
<div class="bloc-gris-full">
    <h2>Une infrastructure fiable et une gestion simplifiée au quotidien</h2>

    <p>
        Nous mettons en place des serveurs d'authentification et de partage sécurisés qui soutiennent la croissance
        de votre activité, pour une disponibilité maximale de vos outils. En centralisant vos demandes clients,
        vos devis et vos encaissements directement via votre boîte mail, vous gagnez un temps précieux
        pour vous consacrer pleinement au développement de votre métier.
    </p>
</div>

<!-- ==== IMAGE + TEXTE ==== -->
<div class="block-white" style="padding:60px 40px;">

    <div class="double-row">
        <img src="{{ asset('images/14466702.webp') }}" alt="Accompagnement de A à Z">

        <div class="double-text">
            <h2>Un accompagnement de A à Z</h2>
            <p>
                Dès la réception de votre message, nous échangeons par téléphone pour comprendre précisément vos besoins.
                Que ce soit pour un dépannage, un serveur ou un site web, Infortom intervient avec réactivité, rigueur
                et pédagogie, puis fait des points d'étape réguliers pour valider chaque détail avant toute mise en service
                ou mise en ligne.
            </p>
        </div>
    </div>

    <div class="double-row">
        <div class="double-text">
            <h2>Le pack tout-en-un pour indépendants et entreprises</h2>
            <p>
                Plus qu'un simple site vitrine, profitez d'une véritable boîte à outils commerciale :
                formulaires sur mesure, réponses automatiques, création de devis rapides, liens de paiement sécurisés…
                Et un accompagnement publicitaire complet sur les réseaux sociaux, avec des campagnes ciblées
                Facebook, Instagram ou Google, à des tarifs adaptés à votre activité et à votre budget.
            </p>

            <a href="{{ route('contact') }}" class="btn-blue">Écrivez-nous aujourd'hui</a>
        </div>

        <img src="{{ asset('images/5583965.webp') }}" alt="Pack tout-en-un">
    </div>

</div>

<!-- ==== MINI FOOTER ==== -->
<div class="mini-footer">
    © 2026 Infortom
</div>

@endsection