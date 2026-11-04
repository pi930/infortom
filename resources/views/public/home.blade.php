@extends('layouts.app')

@section('content')

<style>
    /* ==== STYLES COMMUNS ==== */
    .block { background:#fff; padding:50px 40px; border-radius:12px; margin-top:40px; }
    .block-center { text-align:center; }
    .block h2, .section-title { font-size:32px; font-weight:800; color:#1e3a8a; margin-bottom:15px; }
    .subtitle { font-size:17px; color:#333; max-width:750px; margin:0 auto 35px auto; line-height:1.5; }

    .btn-blue, .btn-outline, .btn-blue-small, .cta-button { text-decoration:none; display:inline-block; border-radius:8px; }
    .btn-blue { background:#1e3a8a; color:#fff; padding:12px 22px; font-size:16px; margin-bottom:12px; }
    .btn-outline { background:#fff; color:#1e3a8a; border:2px solid #1e3a8a; padding:12px 22px; font-size:16px; }
    .btn-blue-small { background:#1e3a8a; color:#fff; padding:10px 20px; font-size:15px; }
    .cta-button { background:#fff; color:#000; padding:12px 26px; font-size:16px; font-weight:600; }

    /* ==== HERO ==== */
    .hero-split { display:flex; align-items:center; justify-content:space-between; background:#f8f9ff; padding:40px; border-radius:12px; margin-top:20px; gap:30px; }
    .hero-left { flex:1; }
    .hero-left h1 { font-size:34px; font-weight:800; color:#1e3a8a; margin-bottom:15px; }
    .hero-left p { font-size:17px; color:#333; margin-bottom:18px; line-height:1.5; }
    .hero-list { background:#fff; border-left:5px solid #1e3a8a; padding:15px; margin:20px 0; border-radius:8px; }
    .hero-list div { margin-bottom:8px; }
    .hero-phone { font-size:22px; font-weight:700; color:#1e3a8a; margin:15px 0; }

    /* ==== GRILLES ==== */
    .grid { display:flex; gap:30px; margin-top:20px; flex-wrap:wrap; }
    .grid-item { flex:1 1 220px; background:#f8f9ff; padding:25px; border-radius:12px; text-align:center; }
    .grid-item img { width:100%; max-width:260px; border-radius:10px; margin-bottom:20px; }
    .grid-item .icon { font-size:44px; margin-bottom:12px; }
    .grid-item h3 { font-size:21px; font-weight:700; color:#1e3a8a; margin-bottom:10px; }
    .grid-item p { font-size:15px; color:#333; margin-bottom:20px; line-height:1.5; }

    /* ==== QUI SOMMES-NOUS ==== */
    .about { display:flex; gap:40px; align-items:stretch; }
    .about > div { flex:1; }
    .about h2 { text-align:left; }
    .about p { font-size:16px; color:#333; line-height:1.6; margin-bottom:15px; }
    .about-box { background:#f8f9ff; border-left:5px solid #1e3a8a; border-radius:8px; padding:25px; }
    .about-box h3 { color:#1e3a8a; font-size:22px; margin-bottom:12px; }

    /* ==== TEMOIGNAGES ==== */
    .testimonial-block { background:#f1f3f6; padding:50px 40px; border-radius:12px; margin-top:40px; text-align:center; }
    .testimonial-grid { display:flex; gap:25px; margin-top:25px; flex-wrap:wrap; }
    .testimonial { flex:1 1 220px; background:#fff; border-radius:12px; padding:25px; }
    .testimonial q { display:block; font-size:16px; font-weight:600; color:#1e3a8a; line-height:1.5; margin-bottom:12px; quotes:none; }
    .testimonial p { font-size:14px; color:#333; }

    /* ==== CTA ==== */
    .cta-blue { background:#1e3a8a; padding:60px 40px; border-radius:12px; margin-top:40px; text-align:center; color:#fff; }
    .cta-blue h2 { font-size:32px; font-weight:800; margin-bottom:15px; color:#fff; }
    .cta-blue p { font-size:17px; max-width:750px; margin:0 auto 30px auto; line-height:1.6; }
    .cta-buttons { display:flex; gap:15px; justify-content:center; flex-wrap:wrap; }

    /* ==== FAQ ==== */
    .faq-grid { display:flex; gap:40px; }
    .faq-column { flex:1; }
    .faq-item { margin-bottom:20px; border-bottom:1px solid #ddd; padding-bottom:10px; }
    .faq-question { font-size:19px; font-weight:700; color:#1e3a8a; display:flex; justify-content:space-between; align-items:center; gap:10px; cursor:pointer; }
    .faq-toggle { background:#1e3a8a; color:#fff; min-width:28px; height:28px; border-radius:50%; display:flex; justify-content:center; align-items:center; font-size:18px; font-weight:bold; }
    .faq-answer { display:none; margin-top:10px; font-size:15px; color:#333; line-height:1.5; background:#f8f9ff; padding:15px; border-radius:8px; }

    /* ==== CONTACT ==== */
    .contact-final { display:flex; background:#fff; border-radius:12px; margin-top:40px; overflow:hidden; }
    .contact-left { flex:1; }
    .contact-left img { width:100%; height:100%; object-fit:cover; }
    .contact-right { flex:1; padding:40px; }
    .contact-right h2 { font-size:32px; font-weight:800; color:#1e3a8a; margin-bottom:25px; }
    .contact-section-title { font-size:20px; font-weight:700; color:#1e3a8a; margin-top:25px; margin-bottom:8px; }
    .contact-text { font-size:15px; color:#333; margin-bottom:8px; }

    /* ==== FOOTER ==== */
    .legal-footer { background:#000; padding:20px 40px; border-radius:12px; margin-top:40px; text-align:center; }
    .legal-footer a { color:#fff; text-decoration:none; font-size:14px; margin:0 12px; }
    .legal-footer a:hover { text-decoration:underline; }

    /* ==== RESPONSIVE ==== */
    @media (max-width:600px) {
        .hero-split { flex-direction:column; text-align:center; padding:25px; }
        .hero-left h1 { font-size:26px; }
        .hero-left p { font-size:15px; }
        .btn-blue, .btn-outline, .cta-button { width:90%; }
        .block, .testimonial-block, .cta-blue { padding:35px 20px; }
        .block h2, .section-title, .cta-blue h2 { font-size:26px; }
        .about, .faq-grid, .contact-final { flex-direction:column; }
        .contact-right { padding:25px; }
        .contact-right h2 { font-size:26px; }
        .faq-question { font-size:17px; }
        .legal-footer { padding:20px 15px; }
        .legal-footer a { display:block; margin:8px 0; }
    }
</style>

<!-- ==== HERO ==== -->
<div class="hero-split">
    <div class="hero-left">
        <h1>Dépannage informatique, serveurs AD et création de sites web à Cannes</h1>

        <p>
            Infortom intervient rapidement pour réparer vos équipements, sécuriser vos systèmes,
            déployer vos serveurs Active Directory et créer votre site internet professionnel
            avec devis automatisés et paiements en ligne.
        </p>

        <div class="hero-list">
            <div>✅ Dépannage matériel et nettoyage système</div>
            <div>✅ Serveurs Active Directory sur mesure</div>
            <div>✅ Réseaux et forfaits de maintenance</div>
            <div>✅ Site web professionnel + nom de domaine inclus</div>
            <div>✅ Référencement Google</div>
            <div>✅ Devis automatisés et paiement en ligne</div>
        </div>

        <p class="hero-phone">📞 07 43 33 44 24</p>

        <a href="tel:0743334424" class="btn-blue">📞 Appeler maintenant</a>
        <br>
        <a href="{{ route('contact') }}" class="btn-outline">💬 Demander un devis gratuit</a>
        <br><br>
        <small style="color:#555;">Basé à Cannes • Particuliers et professionnels • Tarif compétitif</small>
    </div>
</div>

<!-- ==== POURQUOI CHOISIR ==== -->
<div class="block block-center">
    <h2>Pourquoi choisir Infortom ?</h2>
    <p class="subtitle">
        Passionnés par les technologies numériques, nous accompagnons particuliers, auto‑entrepreneurs
        et entreprises avec réactivité, rigueur et pédagogie : de la réparation express d'un poste de travail
        à la création de votre présence en ligne.
    </p>
    <p>
        ✅ Intervention rapide &nbsp; ✅ Diagnostic clair, sans mauvaise surprise<br>
        ✅ Solutions durables et sécurisées &nbsp; ✅ Assistance personnalisée
    </p>
</div>

<!-- ==== PRESTATIONS INFORMATIQUES ==== -->
<div class="block block-center">
    <h2>Nos prestations informatiques</h2>
    <p class="subtitle">
        Que vous soyez un particulier ou un professionnel, nous mettons notre expertise technique
        à votre service pour assurer le bon fonctionnement et la sécurité de votre parc informatique.
    </p>

    <div class="grid">
        <div class="grid-item">
            <div class="icon">🛠️</div>
            <h3>Dépannage matériel</h3>
            <p>Diagnostic complet, remplacement de composants défectueux et optimisation des performances de vos ordinateurs fixes et portables.</p>
            <a href="/services" class="btn-blue-small">En savoir plus</a>
        </div>

        <div class="grid-item">
            <div class="icon">🛡️</div>
            <h3>Nettoyage système</h3>
            <p>Éradication de virus, malwares et logiciels espions pour restaurer la réactivité et la stabilité de votre système d'exploitation.</p>
            <a href="/services" class="btn-blue-small">En savoir plus</a>
        </div>

        <div class="grid-item">
            <div class="icon">🖥️</div>
            <h3>Serveurs Active Directory</h3>
            <p>Conception, installation et configuration complète de serveurs Windows AD pour centraliser la gestion de vos utilisateurs et droits d'accès.</p>
            <a href="/services" class="btn-blue-small">En savoir plus</a>
        </div>

        <div class="grid-item">
            <div class="icon">🌐</div>
            <h3>Réseaux et maintenance</h3>
            <p>Installation de réseaux locaux, sécurisation des accès et forfaits de maintenance régulière pour prévenir les pannes critiques.</p>
            <a href="/services" class="btn-blue-small">En savoir plus</a>
        </div>
    </div>
</div>

<!-- ==== SOLUTIONS WEB / VISIBILITE ==== -->
<div class="block block-center">
    <h2>Des solutions conçues pour votre visibilité</h2>
    <p class="subtitle">
        Développez votre présence en ligne, gérez vos clients en toute simplicité
        et boostez votre chiffre d'affaires sans vous compliquer la vie.
    </p>

    <div class="grid">
        <div class="grid-item">
            <img src="{{ asset('images/3184160.webp') }}" alt="Création de site web">
            <h3>Création de site web harmonieux</h3>
            <p>Un site vitrine élégant et moderne qui valorise votre savoir-faire auprès de vos futurs clients.</p>
            <a href="/services" class="btn-blue-small">En savoir plus</a>
        </div>

        <div class="grid-item">
            <img src="{{ asset('images/7439135.webp') }}" alt="Emails automatisés">
            <h3>Emails et notifications automatisés</h3>
            <p>Gagnez du temps grâce à l'envoi automatique d'emails de confirmation et d'informations pour vos prospects et clients.</p>
            <a href="/services" class="btn-blue-small">En savoir plus</a>
        </div>

        <div class="grid-item">
            <img src="{{ asset('images/20805596.webp') }}" alt="Devis et facturation">
            <h3>Devis et facturation en ligne</h3>
            <p>Proposez des devis clairs et émettez des factures conformes directement reliées à votre activité.</p>
            <a href="/services" class="btn-blue-small">En savoir plus</a>
        </div>

        <div class="grid-item">
            <img src="{{ asset('images/10330119.webp') }}" alt="Paiement sécurisé">
            <h3>Paiement sécurisé et intégré</h3>
            <p>Encaissez vos règlements immédiatement grâce à une plateforme de paiement fiable et transparente.</p>
            <a href="/services" class="btn-blue-small">En savoir plus</a>
        </div>
    </div>
</div>

<!-- ==== QUI SOMMES-NOUS ==== -->
<div class="block">
    <div class="about">
        <div>
            <h2>Qui sommes-nous ?</h2>
            <p>
                Infortom est une entreprise spécialisée dans l'assistance technique, la maintenance informatique,
                la gestion d'infrastructures réseau et la création de sites web.
            </p>
            <p>
                Passionnés par les technologies numériques, nous accompagnons nos clients avec réactivité,
                rigueur et pédagogie. De la réparation express d'un poste de travail à l'architecture complexe
                d'un serveur d'entreprise, nous garantissons des solutions durables et sécurisées.
            </p>
        </div>
        <div class="about-box">
            <h3>Une infrastructure informatique fiable et pérenne</h3>
            <p>
                Nous mettons en place des serveurs d'authentification et de partage sécurisés qui soutiennent
                la croissance de votre activité. Nos interventions garantissent une disponibilité maximale
                de vos outils informatiques au quotidien.
            </p>
        </div>
    </div>
</div>

<!-- ==== TEMOIGNAGES ==== -->
<div class="testimonial-block">
    <h2 class="section-title">Ils nous font confiance</h2>

    <div class="testimonial-grid">
        <div class="testimonial">
            <q>« Panne d'ordinateur résolue en un temps record. Un diagnostic clair, sans mauvaise surprise et un accueil très professionnel. Je recommande vivement ! »</q>
            <p>Marc B.</p>
        </div>
        <div class="testimonial">
            <q>« L'installation de notre serveur Active Directory a transformé la gestion de nos équipes. Tout fonctionne parfaitement et le suivi technique est irréprochable. »</q>
            <p>Sophie D.</p>
        </div>
        <div class="testimonial">
            <q>« Un vrai spécialiste de l'informatique. Il a nettoyé mon système infecté par des malwares et récupéré l'ensemble de mes données professionnelles sans perte. »</q>
            <p>Alexandre M.</p>
        </div>
        <div class="testimonial">
            <q>« Grâce à Infortom, j'ai enfin un site fluide et mes devis partent automatiquement. Un gain de temps énorme pour lancer mon activité. »</q>
            <p>Alexandre D., auto‑entrepreneur à Cannes</p>
        </div>
    </div>
</div>

<!-- ==== CTA ==== -->
<div class="cta-blue">
    <h2>Un problème informatique ? Nous avons la solution</h2>
    <p>
        Ne laissez pas une panne matérielle ou un dysfonctionnement réseau bloquer votre journée.
        Contactez Infortom dès aujourd'hui pour une prise en charge rapide, un devis personnalisé
        pour votre nouveau serveur ou la création de votre site web.
    </p>
    <div class="cta-buttons">
        <a href="tel:0743334424" class="cta-button">📞 Appeler maintenant</a>
        <a href="{{ route('tarifs') }}" class="cta-button">Découvrez nos tarifs</a>
    </div>
</div>

<!-- ==== FAQ ==== -->
<div class="block">
    <h2 class="section-title">Questions fréquentes</h2>
    <p class="subtitle" style="margin-left:0;">
        Retrouvez ici les réponses clés sur nos interventions, la création de sites,
        le nom de domaine inclus et les modalités de facturation.
    </p>

    <div class="faq-grid">
        <div class="faq-column">
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    Intervenez-vous pour les particuliers comme pour les professionnels ?
                    <div class="faq-toggle">+</div>
                </div>
                <div class="faq-answer">
                    Oui. Dépannage d'un ordinateur personnel, nettoyage de virus, installation d'un réseau ou d'un serveur Active Directory pour votre entreprise : nous nous adaptons à chaque situation.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    Est-ce que mes services sont ceux d'un site professionnel ?
                    <div class="faq-toggle">+</div>
                </div>
                <div class="faq-answer">
                    Oui, tout à fait. Même aux tarifs que je pratique, les services sont comparables à ceux proposés par les acteurs du marché.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    Y a-t-il un accompagnement pendant la création, puis un suivi sur les réseaux après la mise en ligne ?
                    <div class="faq-toggle">+</div>
                </div>
                <div class="faq-answer">
                    J'accompagne le client pas à pas, à chaque étape du développement de son site web. Je le référence sur Google. Puis, si le client le souhaite, je réalise une campagne publicitaire sur les réseaux sociaux, à un tarif adapté à ses besoins.
                </div>
            </div>
        </div>

        <div class="faq-column">
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    Proposez-vous des forfaits de maintenance ?
                    <div class="faq-toggle">+</div>
                </div>
                <div class="faq-answer">
                    Oui, des forfaits de maintenance régulière permettent de prévenir les pannes critiques et de sécuriser vos accès. Contactez-nous pour un devis personnalisé.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    Quel est l'intérêt de faire son site chez un informaticien ?
                    <div class="faq-toggle">+</div>
                </div>
                <div class="faq-answer">
                    Sur un site de création automatique en ligne, vous n'avez que les pages visuelles. Vous n'avez pas toutes les pages cachées, réservées au propriétaire, où sont créés tous les outils techniques : messages des visiteurs, devis automatisés, rendez-vous automatisés, paiements en ligne et facturation électronique.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    Mes services sont-ils chers par rapport au marché ?
                    <div class="faq-toggle">+</div>
                </div>
                <div class="faq-answer">
                    Non, mes services sont bien en dessous du prix du marché. Ils ne sont à payer qu'une seule fois.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFaq(el) {
        const answer = el.nextElementSibling;
        const toggle = el.querySelector('.faq-toggle');
        const open = answer.style.display === "block";
        answer.style.display = open ? "none" : "block";
        toggle.textContent = open ? "+" : "-";
    }
</script>

<!-- ==== CONTACT FINAL ==== -->
<div class="contact-final">
    <div class="contact-left">
        <img src="{{ asset('images/13110490.webp') }}" alt="Contact Infortom">
    </div>

    <div class="contact-right">
        <h2>Contactez Infortom</h2>

        <div class="contact-text">Infortom</div>
        <div class="contact-text">Cannes, France</div>

        <div class="contact-section-title">Disponibilités</div>
        <div class="contact-text">Du lundi au vendredi : 9h - 18h</div>
        <div class="contact-text">Samedi : 9h - 12h</div>
        <div class="contact-text">Dimanche : Fermé</div>

        <div class="contact-section-title">Coordonnées</div>
        <div class="contact-text">📞 07 43 33 44 24</div>

        <div style="margin-top:15px;">
            <a href="tel:0743334424" class="btn-blue">📞 Appeler maintenant</a>
        </div>

        <div class="contact-section-title">Suivez nos réalisations</div>
        <div class="contact-text" style="display:flex; align-items:center; gap:12px; margin-top:10px;">
            <a href="https://www.facebook.com/share/18s1hCsu3W/" target="_blank" rel="noopener" style="display:flex; align-items:center; gap:10px;">
                <img src="{{ asset('images/logo-facebook.jpg') }}" alt="Facebook Infortom" style="width:38px; height:38px; border-radius:6px;">
                <span style="font-size:16px; color:#1e3a8a; font-weight:600;">Voir nos réalisations sur Facebook</span>
            </a>
        </div>

        <div class="contact-text" style="margin-top:12px; font-size:14px; color:#444;">
            Facebook demande une connexion pour vérifier votre identité et protéger l’accès aux contenus privés ou sensibles.
        </div>

        <div class="contact-text">© 2026 Infortom</div>
    </div>
</div>

<!-- ==== LIENS LÉGAUX ==== -->
<div class="legal-footer">
    <a href="{{ route('mentions-legales') }}">Mentions légales</a>
    <a href="{{ route('confidentialite') }}">Confidentialité</a>
    <a href="#" onclick="openCookieSettings(); return false;">Gérer les cookies</a>
</div>

@endsection