@extends('layouts.app')

@section('content')

<style>
    .legal-page {
        background: #f1f3f6;
        padding: 50px 40px;
        border-radius: 12px;
        margin-top: 20px;
    }

    .legal-inner {
        max-width: 900px;
        margin: 0 auto;
    }

    .legal-page h1 {
        font-size: 34px;
        font-weight: 800;
        color: #1e3a8a;
        text-align: center;
        margin-bottom: 10px;
    }

    .legal-intro {
        text-align: center;
        font-size: 16px;
        color: #333;
        max-width: 700px;
        margin: 0 auto 35px auto;
        line-height: 1.6;
    }

    .legal-card {
        background: white;
        padding: 28px 30px;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .legal-card h2 {
        font-size: 22px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f3f6;
    }

    .legal-card p {
        font-size: 15px;
        color: #333;
        line-height: 1.7;
        margin-bottom: 8px;
    }

    .legal-card ul {
        margin: 10px 0 0 0;
        padding-left: 20px;
    }

    .legal-card li {
        font-size: 15px;
        color: #333;
        line-height: 1.7;
        margin-bottom: 4px;
    }

    .legal-card a {
        color: #1e3a8a;
        font-weight: 600;
    }

    .legal-highlight {
        background: #f8f9ff;
        padding: 15px 18px;
        border-radius: 8px;
        margin-top: 10px;
    }

    .legal-table-wrap {
        overflow-x: auto;
        margin-top: 12px;
    }

    .legal-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .legal-table th {
        background: #1e3a8a;
        color: white;
        text-align: left;
        padding: 10px 12px;
    }

    .legal-table td {
        padding: 10px 12px;
        border-bottom: 1px solid #ddd;
        color: #333;
        vertical-align: top;
    }

    .legal-cookie-btn {
        background: #1e3a8a;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        font-size: 15px;
        cursor: pointer;
        margin-top: 10px;
    }

    .legal-back {
        text-align: center;
        margin-top: 30px;
    }

    .legal-btn {
        background: #1e3a8a;
        color: white !important;
        padding: 12px 22px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 16px;
        display: inline-block;
    }

    @media (max-width: 600px) {
        .legal-page { padding: 25px 15px; }
        .legal-page h1 { font-size: 26px; }
        .legal-card { padding: 20px; }
        .legal-btn { width: 90%; text-align: center; }
    }
</style>

<div class="legal-page">
    <div class="legal-inner">

        <h1>Déclaration de confidentialité</h1>
        <p class="legal-intro">
            Infortom s’engage à protéger vos données personnelles conformément au Règlement Général
            sur la Protection des Données (RGPD) et à la loi Informatique et Libertés.
            Dernière mise à jour : octobre 2026.
        </p>

        <div class="legal-card">
            <h2>1. Responsable du traitement</h2>
            <p>
                Infortom, micro‑entreprise, 12 impasse Saint Louis, 06400 Cannes<br>
                SIRET : 93818904000034<br>
                Contact : via la page « Support » du site ou au 07 43 33 44 24.
                {{-- Ajoute ici ton adresse email de contact --}}
            </p>
        </div>

        <div class="legal-card">
            <h2>2. Données collectées</h2>
            <p>Les données susceptibles d’être collectées sont :</p>
            <ul>
                <li>informations transmises via les formulaires (nom, email, message),</li>
                <li>informations liées aux demandes de contact ou de devis,</li>
                <li>données techniques nécessaires au fonctionnement du site (adresse IP, logs techniques),</li>
                <li>données de navigation collectées par le pixel Meta, <strong>uniquement si vous les acceptez</strong> (voir section 5).</li>
            </ul>
        </div>

        <div class="legal-card">
            <h2>3. Finalités et bases légales</h2>
            <ul>
                <li><strong>Répondre à vos demandes</strong> (contact, devis) : exécution de mesures précontractuelles ou intérêt légitime.</li>
                <li><strong>Assurer la sécurité et la maintenance du site</strong> : intérêt légitime.</li>
                <li><strong>Mesurer l’efficacité de nos publicités et les optimiser</strong> (pixel Meta) : votre consentement.</li>
            </ul>
            <div class="legal-highlight">
                <p style="margin:0;">
                    Vos données ne sont jamais vendues. Le pixel Meta n’est activé qu’avec votre accord explicite.
                </p>
            </div>
        </div>

        <div class="legal-card">
            <h2>4. Destinataires des données</h2>
            <p>Vos données ne sont <strong>jamais vendues</strong>. Elles peuvent être traitées par :</p>
            <ul>
                <li><strong>Render.com</strong> : hébergement du site,</li>
                <li><strong>Meta Platforms Ireland Limited</strong> : uniquement si vous acceptez le pixel Meta,</li>
                <li>nos prestataires techniques strictement nécessaires au fonctionnement du service (envoi d’emails, paiement sécurisé).</li>
            </ul>
            <p style="margin-top:10px;">
                Certains de ces prestataires, dont Meta, peuvent traiter des données en dehors de l’Union européenne,
                notamment aux États‑Unis, dans le cadre de garanties prévues par le RGPD (clauses contractuelles types
                ou décision d’adéquation).
            </p>
        </div>

        <div class="legal-card">
            <h2>5. Cookies et pixel Meta</h2>
            <p>
                Lors de votre première visite, un bandeau vous permet d’accepter ou de refuser les cookies
                non essentiels. Sans votre accord, aucun cookie publicitaire n’est déposé.
            </p>

            <div class="legal-table-wrap">
                <table class="legal-table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Émetteur</th>
                            <th>Finalité</th>
                            <th>Durée</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>infortom_cookie_consent</td>
                            <td>Infortom</td>
                            <td>Mémoriser votre choix concernant les cookies</td>
                            <td>6 mois</td>
                        </tr>
                        <tr>
                            <td>_fbp</td>
                            <td>Meta</td>
                            <td>Mesure des performances publicitaires et reciblage</td>
                            <td>3 mois</td>
                        </tr>
                        <tr>
                            <td>_fbc</td>
                            <td>Meta</td>
                            <td>Attribuer une visite à une publicité Facebook ou Instagram</td>
                            <td>3 mois</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p style="margin-top:14px;">
                Vous pouvez modifier ou retirer votre consentement à tout moment :
            </p>
            <button type="button" class="legal-cookie-btn" onclick="openCookieSettings()">Gérer mes cookies</button>
            <p style="margin-top:14px;">
                Pour en savoir plus sur le traitement des données par Meta :
                <a href="https://www.facebook.com/privacy/policy" target="_blank" rel="noopener">politique de confidentialité de Meta</a>.
            </p>
        </div>

        <div class="legal-card">
            <h2>6. Durée de conservation</h2>
            <ul>
                <li>Demandes de contact et de devis : 3 ans maximum après le dernier échange.</li>
                <li>Logs techniques : 12 mois maximum.</li>
                <li>Cookies : 6 mois pour votre choix de consentement, 3 mois pour les cookies Meta.</li>
            </ul>
        </div>

        <div class="legal-card">
            <h2>7. Vos droits</h2>
            <p>Conformément au RGPD, vous disposez des droits suivants :</p>
            <ul>
                <li>droit d’accès,</li>
                <li>droit de rectification,</li>
                <li>droit à l’effacement,</li>
                <li>droit d’opposition,</li>
                <li>droit à la limitation du traitement,</li>
                <li>droit à la portabilité,</li>
                <li>droit de retirer votre consentement à tout moment.</li>
            </ul>
            <p style="margin-top:12px;">
                Pour exercer vos droits, contactez-nous via la page « Support ». Si vous estimez, après nous avoir contactés,
                que vos droits ne sont pas respectés, vous pouvez introduire une réclamation auprès de la
                <a href="https://www.cnil.fr" target="_blank" rel="noopener">CNIL</a>.
            </p>
        </div>

        <div class="legal-card">
            <h2>8. Sécurité</h2>
            <p>
                Infortom met en œuvre les mesures techniques et organisationnelles nécessaires pour protéger
                vos données contre tout accès non autorisé, perte ou divulgation.
            </p>
        </div>

        <div class="legal-back">
            <a href="{{ url('/') }}" class="legal-btn">Retour à l'accueil</a>
        </div>

    </div>
</div>

@endsection