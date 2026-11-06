@extends('layouts.app')

@section('title', 'Contact - Infortom | Devis gratuit site web à Cannes, réponse sous 48h')
@section('description', 'Appelez ou écrivez à Infortom à Cannes pour obtenir un devis gratuit pour votre site web professionnel. Réponse sous 48h.')

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
    .btn-blue { background:#1e3a8a; color:#fff; padding:12px 22px; font-size:16px; font-weight:700; text-decoration:none; display:inline-block; border-radius:8px; margin-bottom:12px; }
    .btn-outline { background:#fff; color:#1e3a8a; border:2px solid #1e3a8a; padding:12px 22px; font-size:16px; font-weight:700; text-decoration:none; display:inline-block; border-radius:8px; }

    /* ==== CONTACT ==== */
    .contact-header { width:100%; background:#ffffff; padding:50px 40px; text-align:left; box-sizing:border-box; }
    .contact-header h2 { font-size:34px; font-weight:800; color:#1e3a8a; margin-bottom:20px; }
    .contact-header p { font-size:17px; color:#333; max-width:900px; line-height:1.6; }

    .contact-container { display:flex; gap:40px; padding:50px 40px; background:#ffffff; }
    .contact-left { flex:1; text-align:left; }
    .contact-left img { width:100%; border-radius:10px; margin-bottom:20px; }
    .contact-left h2 { font-size:26px; font-weight:800; color:#1e3a8a; margin-bottom:10px; }
    .contact-left p { font-size:16px; color:#333; line-height:1.5; margin-bottom:10px; }

    .contact-right { flex:1; background:#f7f7f7; padding:30px; border-radius:10px; }
    .contact-right h2 { font-size:26px; font-weight:800; color:#1e3a8a; margin-bottom:20px; }
    .contact-right label { font-size:15px; font-weight:600; color:#333; display:block; margin-bottom:6px; }
    .contact-right input, .contact-right textarea { width:100%; padding:12px; border:1px solid #ccc; border-radius:8px; margin-bottom:20px; font-size:15px; box-sizing:border-box; }
    .contact-right textarea { height:140px; resize:none; }
    .contact-btn { background:#1e3a8a; color:white; padding:14px 30px; border-radius:8px; font-size:16px; font-weight:600; border:none; cursor:pointer; width:100%; }

    @media (max-width:768px) {
        .contact-container { flex-direction:column; padding:30px 20px; }
        .contact-header { padding:35px 20px; }
    }
    @media (max-width:600px) {
        .hero-split { flex-direction:column; text-align:center; padding:25px; }
        .hero-left h1 { font-size:26px; }
        .btn-blue, .btn-outline { width:90%; box-sizing:border-box; }
    }
</style>

<!-- ==== HERO ==== -->
<div class="hero-split">
    <div class="hero-left">
        <span class="hero-badge">⏱️ Réponse sous 48h</span>
        <h1>Décrivez votre projet, on s'occupe du reste.</h1>

        <p>
            Vous lancez votre activité d'auto‑entrepreneur à Cannes ? Demandez votre devis gratuit :
            nous étudions votre demande avec attention et vous répondons sous 48h.
        </p>

        <div class="hero-list">
            <div>✅ Devis gratuit et sans engagement</div>
            <div>✅ Site clé en main avec messagerie automatique</div>
            <div>✅ Devis, factures et paiements intégrés</div>
            <div>✅ Échange par téléphone dès réception de votre message</div>
        </div>

        <p class="hero-phone">📞 07 43 33 44 24</p>

        <a href="#formulaire" class="btn-blue">💬 Remplir le formulaire de devis</a>
        <br>
        <a href="tel:0743334424" class="btn-outline">📞 Préférer appeler maintenant</a>
    </div>
</div>

<!-- ==== BANDEAU BLANC ==== -->
<div class="contact-header">
    <h2>Contactez Infortom</h2>

    <p>
        Vous lancez votre activité d'auto‑entrepreneur et souhaitez développer votre visibilité en ligne ?
        Infortom conçoit pour vous un site web moderne, clé en main avec messagerie automatique, devis,
        factures et paiements intégrés. Écrivez‑nous via le formulaire ci‑dessous : nous étudions votre
        demande avec attention et vous répondons sous 48h.
    </p>
</div>

<!-- ==== CONTENU PRINCIPAL ==== -->
<div class="contact-container">

    <!-- ==== COLONNE GAUCHE ==== -->
    <div class="contact-left">
        <img src="{{ asset('images/localisation.png') }}" alt="Contact Infortom">

        <h2>Localisation</h2>
        <p>Cannes, France</p>

        <h2>Téléphone</h2>
        <p><a href="tel:0743334424" style="color:#1e3a8a; font-weight:700; text-decoration:none;">📞 07 43 33 44 24</a></p>
        <p>Du lundi au vendredi : 9h - 18h<br>Samedi : 9h - 12h<br>Dimanche : fermé</p>

        <h2>E-mail</h2>
        <p>contact@infortom.fr</p>

        <h2>Réseaux sociaux</h2>

        <a href="https://www.facebook.com/share/18s1hCsu3W/"
           target="_blank" rel="noopener"
           style="display:flex; align-items:center; gap:10px;">
            <img src="{{ asset('images/logo-facebook.jpg') }}"
                 alt="Facebook Infortom"
                 style="width:32px; height:32px; margin-bottom:0;">
            <span style="font-size:16px; color:#1e3a8a; font-weight:600;">Facebook</span>
        </a>
    </div>

    <!-- ==== COLONNE DROITE : FORMULAIRE ==== -->
    <div class="contact-right" id="formulaire">
        <h2>Démarrez votre projet</h2>

        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <label>Sujet *</label>
            <input type="text" name="subject" required>

            <label>Nom *</label>
            <input type="text" name="name" required>

            <label>Adresse e-mail *</label>
            <input type="email" name="email" required>

            <label>Téléphone</label>
            <input type="text" name="phone">

            <label>Message *</label>
            <textarea name="message" required></textarea>

            <button type="submit" class="contact-btn">Envoyer ma demande</button>
        </form>
    </div>

</div>

@endsection