@extends('layouts.app')

@section('content')


<!-- ==== HERO RECTANGULAIRE DIVISÉ EN 2 ==== -->
<style>
    .hero-split {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f8f9ff;
        padding: 40px;
        border-radius: 12px;
        margin-top: 20px;
        gap: 30px;
    }

    .hero-left {
        flex: 1;
    }

    .hero-left h1 {
        font-size: 34px;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 15px;
    }

    .hero-left p {
        font-size: 17px;
        color: #333;
        margin-bottom: 18px;
        line-height: 1.5;
    }

    .btn-blue {
        background: #1e3a8a;
        color: white;
        padding: 12px 22px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 16px;
        display: inline-block;
        margin-bottom: 12px;
    }

    .btn-outline {
        background: white;
        color: #1e3a8a;
        border: 2px solid #1e3a8a;
        padding: 12px 22px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 16px;
        display: inline-block;
    }

    .hero-right {
        flex: 1;
        text-align: right;
    }

    .hero-right img {
        max-width: 100%;
        border-radius: 12px;
    }

    /* ==== RESPONSIVE SMARTPHONE ==== */
    @media (max-width: 600px) {
        .hero-split {
            flex-direction: column;
            text-align: center;
            padding: 25px;
        }

        .hero-right {
            text-align: center;
        }

        .hero-left h1 {
            font-size: 26px;
        }

        .hero-left p {
            font-size: 15px;
        }

        .btn-blue, .btn-outline {
            width: 90%;
        }
    }
</style>

<div class="hero-split">

    <!-- ==== TEXTE À GAUCHE ==== -->
    <div class="hero-left">

    <h1>
        Création de sites web professionnels pour auto‑entrepreneurs à Cannes
    </h1>

    <p>
        Site internet clé en main avec devis automatisés, facturation en ligne,
        paiements sécurisés et accompagnement personnalisé.
    </p>

    <div style="
        background:#ffffff;
        border-left:5px solid #1e3a8a;
        padding:15px;
        margin:20px 0;
        border-radius:8px;
    ">

        <div style="margin-bottom:8px;">
            ✅ Site web professionnel
        </div>

        <div style="margin-bottom:8px;">
            ✅ Nom de domaine inclus
        </div>

        <div style="margin-bottom:8px;">
            ✅ Référencement Google
        </div>

        <div style="margin-bottom:8px;">
            ✅ Devis automatisés
        </div>

        <div style="margin-bottom:8px;">
            ✅ Paiement en ligne
        </div>

        <div>
            ✅ Accompagnement personnalisé
        </div>

    </div>

    <p style="
        font-size:22px;
        font-weight:700;
        color:#1e3a8a;
        margin:15px 0;
    ">
        📞 07 43 33 44 24
    </p>

    <a href="tel:0743334424" class="btn-blue">
        📞 Appeler maintenant
    </a>

    <br>

    <a href="{{ route('contact') }}" class="btn-outline">
        💬 Demander un devis gratuit
    </a>

    <br><br>

    <small style="color:#555;">
        Basé à Cannes • Accompagnement local • Tarif compétitif
    </small>

</div>

</div>
<div style="
background:#ffffff;
padding:30px;
margin-top:30px;
border-radius:12px;
text-align:center;
">
 
<h2 style="color:#1e3a8a;">
Pourquoi choisir Infortom ?
</h2>
 
<p>
Infortom accompagne les auto‑entrepreneurs dans la création
de leur présence en ligne avec des outils utilisés par les
professionnels :
</p>
 
<p>
✅ Site vitrine moderne
<br>
✅ Référencement Google
<br>
✅ Formulaires de contact
<br>
✅ Devis automatisés
<br>
✅ Paiements en ligne
<br>
✅ Assistance personnalisée
</p>
 
</div>


<!-- ==== BLOC SOLUTIONS VISIBILITÉ ==== -->
<style>
    .solutions-block {
        background: white;
        padding: 50px 40px;
        border-radius: 12px;
        margin-top: 40px;
        text-align: center;
    }

    .solutions-block h2 {
        font-size: 32px;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 15px;
    }

    .solutions-block p.subtitle {
        font-size: 17px;
        color: #333;
        max-width: 700px;
        margin: 0 auto 40px auto;
        line-height: 1.5;
    }

    .solutions-grid {
        display: flex;
        justify-content: space-between;
        gap: 30px;
        margin-top: 20px;
    }

    .solution-item {
        flex: 1;
        background: #f8f9ff;
        padding: 25px;
        border-radius: 12px;
        text-align: center;
    }

    .solution-item img {
        width: 100%;
        max-width: 260px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .solution-item h3 {
        font-size: 22px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 10px;
    }

    .solution-item p {
        font-size: 15px;
        color: #333;
        margin-bottom: 20px;
        line-height: 1.5;
    }

    .btn-blue-small {
        background: #1e3a8a;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 15px;
        display: inline-block;
    }

    /* ==== RESPONSIVE ==== */
    @media (max-width: 600px) {
        .solutions-grid {
            flex-direction: column;
        }

        .solution-item img {
            max-width: 90%;
        }
    }
</style>

<div class="solutions-block">

    <!-- TITRE PRINCIPAL -->
    <h2>Des solutions conçues pour votre visibilité</h2>

    <!-- SOUS-TITRE -->
    <p class="subtitle">
        Tout le nécessaire pour développer votre présence en ligne, gérer vos clients en toute simplicité
        et booster votre chiffre d'affaires sans vous compliquer la vie.
    </p>

    <!-- GRID 2 COLONNES -->
    <div class="solutions-grid">

        <!-- ==== COLONNE GAUCHE ==== -->
        <div class="solution-item">
            <img src="{{ asset('images/3184160.webp') }}" alt="Création de site web">
            <h3>Création de site web harmonieux</h3>
            <p>
                Un site internet vitrine élégant et moderne qui valorise votre savoir-faire d'auto‑entrepreneur
                auprès de vos futurs clients.
            </p>
            <a href="#" class="btn-blue-small">En savoir plus</a>
        </div>

        <!-- ==== COLONNE DROITE ==== -->
        <div class="solution-item">
            <img src="{{ asset('images/7439135.webp') }}" alt="Emails automatisés">
            <h3>Emails et notifications automatisés</h3>
            <p>
                Gagnez du temps précieux grâce à l'envoi automatique d'emails de confirmation et d'informations
                pour vos prospects et clients.
            </p>
            <a href="#" class="btn-blue-small">En savoir plus</a>
        </div>

    </div>
</div>

<!-- ==== BLOC DEVIS & PAIEMENT ==== -->
<style>
    .billing-block {
        background: white;
        padding: 50px 40px;
        border-radius: 12px;
        margin-top: 40px;
    }

    .billing-grid {
        display: flex;
        justify-content: space-between;
        gap: 30px;
    }

    .billing-item {
        flex: 1;
        background: #f8f9ff;
        padding: 25px;
        border-radius: 12px;
        text-align: center;
    }

    .billing-item img {
        width: 100%;
        max-width: 260px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .billing-item h3 {
        font-size: 22px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 10px;
    }

    .billing-item p {
        font-size: 15px;
        color: #333;
        margin-bottom: 20px;
        line-height: 1.5;
    }

    .btn-blue-small {
        background: #1e3a8a;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 15px;
        display: inline-block;
    }

    /* ==== RESPONSIVE ==== */
    @media (max-width: 600px) {
        .billing-grid {
            flex-direction: column;
        }

        .billing-item img {
            max-width: 90%;
        }
    }
</style>

<div class="billing-block">

    <div class="billing-grid">

        <!-- ==== COLONNE GAUCHE ==== -->
        <div class="billing-item">
            <img src="{{ asset('images/20805596.webp') }}" alt="Devis et facturation">
            <h3>Devis et facturation en ligne</h3>
            <p>
                Proposez des devis clairs et émettez des factures conformes directement reliées à votre activité professionnelle.
            </p>
            <a href="#" class="btn-blue-small">En savoir plus</a>
        </div>

        <!-- ==== COLONNE DROITE ==== -->
        <div class="billing-item">
            <img src="{{ asset('images/10330119.webp') }}" alt="Paiement sécurisé">
            <h3>Paiement sécurisé et intégré</h3>
            <p>
                Encaissez vos règlements immédiatement grâce à une plateforme de paiement fiable et transparente pour vos clients.
            </p>
            <a href="#" class="btn-blue-small">En savoir plus</a>
        </div>

    </div>
</div>

<!-- ==== BLOC TEMOIGNAGE ==== -->
<style>
    .testimonial-block {
        background: #f1f3f6;
        padding: 50px 40px;
        border-radius: 12px;
        margin-top: 40px;
        text-align: center;
    }

    .testimonial-block h3 {
        font-size: 26px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 15px;
        line-height: 1.5;
    }

    .testimonial-block p {
        font-size: 14px;
        color: #333;
        margin-top: 5px;
    }

    @media (max-width: 600px) {
        .testimonial-block h3 {
            font-size: 22px;
        }
        .testimonial-block p {
            font-size: 13px;
        }
    }
</style>

<div class="testimonial-block">
    <h3>
        « Grâce à infortom, j'ai enfin un site fluide et mes devis partent automatiquement.
        Un gain de temps énorme pour lancer mon activité. »
    </h3>

    <p>Alexandre D., auto‑entrepreneur à Cannes</p>
</div>

<!-- ==== BLOC BLEU CTA ==== -->
<style>
    .cta-blue {
        background: #1e3a8a;
        padding: 60px 40px;
        border-radius: 12px;
        margin-top: 40px;
        text-align: center;
        color: white;
    }

    .cta-blue h2 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 15px;
    }

    .cta-blue p {
        font-size: 17px;
        max-width: 700px;
        margin: 0 auto 30px auto;
        line-height: 1.6;
    }

    .cta-button {
        background: white;
        color: #000;
        padding: 12px 26px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        display: inline-block;
    }

    @media (max-width: 600px) {
        .cta-blue h2 {
            font-size: 26px;
        }
        .cta-blue p {
            font-size: 15px;
        }
        .cta-button {
            width: 90%;
        }
    }
</style>

<div class="cta-blue">
    <h2>Faites décoller votre activité dès aujourd'hui</h2>

    <p>
        Infortom accompagne chaque indépendant dans la réussite de son projet web.
        Bénéficiez d'un outil complet à un tarif compétitif et faites grandir votre entreprise en toute sérénité.
    </p>

    <a href="{{ route('tarifs') }}" class="cta-button">Découvrez nos tarifs</a>
</div>
<!-- ==== BLOC FAQ ==== -->
<style>
    .faq-block {
        background: white;
        padding: 50px 40px;
        border-radius: 12px;
        margin-top: 40px;
    }

    .faq-title {
        font-size: 32px;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 10px;
        text-align: left;
    }

    .faq-subtitle {
        font-size: 16px;
        color: #333;
        margin-bottom: 35px;
        max-width: 700px;
    }

    .faq-grid {
        display: flex;
        gap: 40px;
    }

    .faq-column {
        flex: 1;
    }

    .faq-item {
        margin-bottom: 20px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }

    .faq-question {
        font-size: 20px;
        font-weight: 700;
        color: #1e3a8a;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }

    .faq-toggle {
        background: #1e3a8a;
        color: white;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        font-weight: bold;
        transition: 0.3s;
    }

    .faq-answer {
        display: none;
        margin-top: 10px;
        font-size: 15px;
        color: #333;
        line-height: 1.5;
        background: #f8f9ff;
        padding: 15px;
        border-radius: 8px;
    }

    /* ==== RESPONSIVE ==== */
    @media (max-width: 600px) {
        .faq-grid {
            flex-direction: column;
        }
        .faq-title {
            font-size: 26px;
        }
        .faq-question {
            font-size: 18px;
        }
    }
</style>

<div class="faq-block">

    <!-- TITRE -->
    <h2 class="faq-title">Questions fréquentes</h2>

    <!-- SOUS-TITRE -->
    <p class="faq-subtitle">
        Vous lancez votre activité et souhaitez comprendre notre fonctionnement ?
        Retrouvez ici toutes les réponses clés sur nos créations de sites, le nom de domaine inclus
        et les modalités de facturation.
    </p>

    <!-- GRID 2 COLONNES -->
    <div class="faq-grid">

        <!-- ==== COLONNE GAUCHE ==== -->
        <div class="faq-column">

            <!-- 1 -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    Est ce que mes services sont ceux d'un site proféssionel ?
                    <div class="faq-toggle">+</div>
                </div>
                <div class="faq-answer">
                   Oui, tout à fait , même aux tarifs que je pratique , les services sont comparativement semblables à ceux proposés par les acteurs du marché. 
                </div>
            </div>

            <!-- 2 -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    Un accompagnement tout au long du processus de creation , puis un suivi sur les réseaux aprés la mise en ligne du site 
                    <div class="faq-toggle">+</div>
                </div>
                <div class="faq-answer">
                    J'accompagne, pas à pas , le client à chaques étapes du dévellopement de son site web . Je le reférence sur google . Puis , si le client le désir , je fais une campagne publicitaire sur les réseaux à un tarifs adapté aux besoins du client. 
            </div>

           
        </div>

        <!-- ==== COLONNE DROITE ==== -->
        <div class="faq-column">

            <!-- 5 -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    Quelle est l'intêret de faire son site chez un ibformaticien 
                    <div class="faq-toggle">+</div>
                </div>
                <div class="faq-answer">
                    L'intêret est que chez un site de créations automatique en ligne , vous n'avez que les pages visuelles , vous n'avez pas tous les pages cachées, réserver aux propriétaire, ou sont crées tous les outils téchniques : messages des visiteurs, devis automatisés, rendez-vous automatisés, paiements en ligne et facturation éléctronique. 
                </div>
            </div>

            <!-- 6 -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    Est-ce que mes services sont cheres par rapport au marché 
                    <div class="faq-toggle">+</div>
                </div>
                <div class="faq-answer">
                    Non, mes services sont bien en dessous du prix du marché , ils sont seulement une seule fois à payer
                </div>
            </div>

        </div>

    </div>
</div>

<!-- ==== SCRIPT ACCORDEON ==== -->
<script>
    function toggleFaq(el) {
        const answer = el.nextElementSibling;
        const toggle = el.querySelector('.faq-toggle');

        if (answer.style.display === "block") {
            answer.style.display = "none";
            toggle.textContent = "+";
        } else {
            answer.style.display = "block";
            toggle.textContent = "-";
        }
    }
</script>
<!-- ==== BLOC CONTACT FINAL ==== -->
<style>
    .contact-final {
        display: flex;
        background: white;
        border-radius: 12px;
        margin-top: 40px;
        overflow: hidden;
    }

    .contact-left {
        flex: 1;
    }

    .contact-left img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .contact-right {
        flex: 1;
        padding: 40px;
    }

    .contact-right h2 {
        font-size: 32px;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 25px;
    }

    .contact-section-title {
        font-size: 20px;
        font-weight: 700;
        color: #1e3a8a;
        margin-top: 25px;
        margin-bottom: 8px;
    }

    .contact-text {
        font-size: 15px;
        color: #333;
        margin-bottom: 8px;
    }

    /* ==== RESPONSIVE ==== */
    @media (max-width: 600px) {
        .contact-final {
            flex-direction: column;
        }

        .contact-right {
            padding: 25px;
        }

        .contact-right h2 {
            font-size: 26px;
        }
    }
</style>

<div class="contact-final">

    <!-- ==== IMAGE GAUCHE ==== -->
    <div class="contact-left">
        <img src="{{ asset('images/13110490.webp') }}" alt="Contact Infortom">
    </div>

    <!-- ==== TEXTE DROITE ==== -->
    <div class="contact-right">

        <h2>Contactez infortom</h2>

        <div class="contact-text">infortom</div>
        <div class="contact-text">Cannes, France</div>

        <div class="contact-section-title">Disponibilités</div>
        <div class="contact-text">Du lundi au vendredi : 9h - 18h</div>
        <div class="contact-text">Samedi : 9h - 12h</div>
        <div class="contact-text">Dimanche : Fermé</div>

        <div class="contact-section-title">Coordonnées</div>
        <div class="contact-text">
📞 07 43 33 44 24
</div>

<div style="margin-top:15px;">
    <a href="tel:0743334424" class="btn-blue">
        📞 Appeler maintenant
    </a>
</div>

        <div class="contact-section-title">Suivez nos réalisations</div>

<!-- Icône Facebook + lien -->
<div class="contact-text" style="display:flex; align-items:center; gap:12px; margin-top:10px;">

    <a href="https://www.facebook.com/share/18s1hCsu3W/" target="_blank" style="display:flex; align-items:center; gap:10px;">
        <img src="{{ asset('images/logo-facebook.jpg') }}" 
             alt="Facebook Infortom" 
             style="width:38px; height:38px; border-radius:6px;">
        <span style="font-size:16px; color:#1e3a8a; font-weight:600;">
            Voir nos réalisations sur Facebook
        </span>
    </a>
</div>

<!-- Explication -->
<div class="contact-text" style="margin-top:12px; font-size:14px; color:#444;">
    Facebook demande une connexion pour vérifier votre identité et protéger l’accès aux contenus privés ou sensibles.
</div>

<div class="contact-text">© 2026 infortom</div>


    </div>

</div>



<!-- ==== BANDE NOIRE LIENS LÉGAUX ==== -->
<style>
    .legal-footer {
        background: #000;
        padding: 20px 40px;
        border-radius: 12px;
        margin-top: 40px;
        text-align: center;
    }

    .legal-footer a {
        color: white;
        text-decoration: none;
        font-size: 14px;
        margin: 0 12px;
    }

    .legal-footer a:hover {
        text-decoration: underline;
    }

    @media (max-width: 600px) {
        .legal-footer {
            padding: 20px 15px;
        }

        .legal-footer a {
            display: block;
            margin: 8px 0;
        }
    }
</style>

<div class="legal-footer">
    <a href="{{ route('mentions-legales') }}">Mentions légales</a>
    <a href="{{ route('confidentialite') }}">Confidentialité</a>
    <a href="#" onclick="openCookieSettings(); return false;">Gérer les cookies</a>
</div>
@endsection