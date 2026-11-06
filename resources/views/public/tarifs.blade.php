@extends('layouts.app')

@section('title', 'Site web à 200 € - Infortom | Création de site à Cannes, paiement unique')
@section('description', 'Site web clé en main pour auto-entrepreneurs à Cannes : 200 €, nom de domaine, hébergement, devis, factures et paiement en ligne inclus. Paiement unique.')

@section('content')

<style>
    /* ==== HERO ==== */
    .hero-split { display:flex; align-items:center; background:linear-gradient(135deg, #f8f9ff 0%, #e2e8f0 100%); padding:45px; border-radius:12px; margin-top:20px; margin-bottom:40px; box-shadow:0 4px 15px rgba(0,0,0,0.05); }
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

    /* ==== FORMULE ==== */
    .tarifs-pack { background:#ffffff; padding:50px 30px; border-radius:8px; margin-bottom:40px; text-align:center; }
    .tarifs-pack h2 { font-size:32px; color:#3f8cff; font-weight:bold; margin-bottom:15px; }
    .tarifs-pack p { font-size:18px; color:#333; max-width:900px; margin:auto; line-height:1.6; margin-bottom:40px; }
    .tarifs-table { width:100%; max-width:700px; margin:auto; border-collapse:collapse; font-size:18px; }
    .tarifs-table th { background:#3f8cff; color:white; padding:15px; border:2px solid #000; font-size:20px; }
    .tarifs-table td { padding:15px; border:2px solid #000; color:#000; background:#fff; }
    .tarifs-actions { margin-top:35px; }

    /* ==== CTA ==== */
    .cta-blue { background:#3f51b5; padding:60px 30px; text-align:center; border-radius:8px; margin-top:40px; margin-bottom:40px; color:white; }
    .cta-blue h2 { font-size:34px; font-weight:bold; margin-bottom:15px; }
    .cta-blue p { font-size:18px; max-width:900px; margin:auto; line-height:1.6; }
    .cta-buttons { display:flex; gap:15px; justify-content:center; flex-wrap:wrap; margin-top:30px; }
    .cta-button { background:#fff; color:#000; padding:12px 26px; font-size:16px; font-weight:600; text-decoration:none; display:inline-block; border-radius:8px; }

    .footer-black { background:#000; color:#fff; text-align:center; padding:15px 0; margin-top:40px; border-radius:6px; font-size:14px; }

    @media (max-width:600px) {
        .hero-split { flex-direction:column; text-align:center; padding:25px; }
        .hero-left h1 { font-size:26px; }
        .btn-blue, .btn-outline, .cta-button { width:90%; box-sizing:border-box; }
        .tarifs-pack h2, .cta-blue h2 { font-size:26px; }
        .tarifs-pack p, .cta-blue p { font-size:16px; }
        .tarifs-table { font-size:15px; }
        .tarifs-table th { font-size:17px; }
    }
</style>

<!-- ==== HERO ==== -->
<div class="hero-split">
    <div class="hero-left">
        <span class="hero-badge">💶 Paiement unique</span>
        <h1>Votre site pro à 200 €, hébergement et nom de domaine inclus.</h1>

        <p>
            Auto‑entrepreneur à Cannes ou ailleurs en France : une offre transparente, complète et sans frais cachés
            pour lancer votre présence en ligne en toute sérénité.
        </p>

        <div class="hero-list">
            <div>✅ Site web clé en main</div>
            <div>✅ E‑mails automatiques, devis et factures</div>
            <div>✅ Paiement en ligne intégré</div>
            <div>✅ Hébergement, maintenance et code source inclus</div>
            <div>✅ Un seul paiement, aucun abonnement</div>
        </div>

        <p class="hero-phone">📞 07 43 33 44 24</p>

        <a href="{{ route('contact') }}" class="btn-blue">💬 Demander un devis gratuit</a>
        <br>
        <a href="tel:0743334424" class="btn-outline">📞 Appeler maintenant</a>
    </div>
</div>

<!-- ==== TITRE ==== -->
<div class="tarifs-pack" style="margin-bottom:40px;">
    <h2>Nos tarifs clairs et accessibles</h2>
    <p style="margin-bottom:0;">
        Chez Infortom, nous accompagnons chaque nouvel auto‑entrepreneur avec une offre transparente,
        complète et sans frais cachés. Lancez votre présence en ligne en toute sérénité à Cannes
        et partout en France.
    </p>
</div>

<!-- ==== FORMULE TOUT-EN-UN ==== -->
<div class="tarifs-pack">
    <h2>Formule tout‑en‑un</h2>

    <p>
        Profitez d'un pack complet à <strong>200 € seulement</strong> (avec <strong>100 € d'acompte</strong> à la commande).
        Cette formule comprend la création de votre site web, les e‑mails automatiques, la gestion des devis,
        factures et paiements en ligne, l'hébergement, le nom de domaine, la maintenance réactive et le contrôle
        total sur votre code source.
    </p>

    <table class="tarifs-table">
        <tr>
            <th>Options</th>
            <th>Prix</th>
        </tr>
        <tr>
            <td>Site tout‑en‑un</td>
            <td>200 €</td>
        </tr>
        <tr>
            <td>Acompte</td>
            <td>100 €</td>
        </tr>
        <tr>
            <td>Nom de domaine</td>
            <td>6,00 €</td>
        </tr>
        <tr>
            <td>Campagne réseaux sociaux</td>
            <td>100 € + coût de la campagne</td>
        </tr>
        <tr>
            <td>Création de serveur AD</td>
            <td>250 €</td>
        </tr>
    </table>

    <div class="tarifs-actions">
        <a href="{{ route('contact') }}" class="btn-blue">Demander un devis gratuit</a>
    </div>
</div>

<!-- ==== CTA ==== -->
<div class="cta-blue">
    <h2>Prêt à propulser votre activité ?</h2>

    <p>
        Discutons de votre projet dès aujourd'hui et donnez à votre entreprise
        le site internet professionnel et fonctionnel qu'elle mérite.
    </p>

    <div class="cta-buttons">
        <a href="tel:0743334424" class="cta-button">📞 Appeler maintenant</a>
        <a href="{{ route('contact') }}" class="cta-button">Nous contacter</a>
    </div>
</div>

<div class="footer-black">
    © 2026 infortom
</div>

@endsection