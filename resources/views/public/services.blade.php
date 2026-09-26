@extends('layouts.app')

@section('content')

<!-- ==== BLOC BLEU FULL WIDTH ==== -->
<style>
    .full-blue {
        width: 100%;
        background: #1e3a8a;
        color: white;
        padding: 60px 30px;
        text-align: center;
    }

    .full-blue h1 {
        font-size: 34px;
        font-weight: 800;
        margin-bottom: 20px;
    }

    .full-blue p {
        font-size: 17px;
        max-width: 900px;
        margin: 0 auto 35px auto;
        line-height: 1.6;
    }

    .full-blue .cta-white {
        background: white;
        color: black;
        padding: 14px 30px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        display: inline-block;
    }

    @media (max-width: 600px) {
        .full-blue h1 {
            font-size: 26px;
        }
        .full-blue p {
            font-size: 15px;
        }
        .full-blue .cta-white {
            width: 90%;
        }
    }
</style>

<div class="full-blue">
    <h1>Des solutions web complètes pour lancer votre activité</h1>

    <p>
       Des solutions web complètes pour lancer votre activité

Chez Infortom, nous accompagnons les nouveaux auto‑entrepreneurs avec des sites web harmonieux
et des outils automatiques intégrés : emails, devis, paiements et factures professionnelles à des tarifs accessibles.
Nous proposons également un accompagnement publicitaire sur les réseaux sociaux,
pour booster votre visibilité dès le lancement, avec des campagnes personnalisées et des tarifs adaptés à votre budget.
    </p>

    <a href="{{ route('tarifs') }}" class="cta-white">Découvrez nos tarifs</a>
</div>

<!-- ==== BLOC FORMULES FULL WIDTH ==== -->
<style>
    .formules-block {
        width: 100%;
        background: #ffffff;
        padding: 50px 40px;
    }

    .formules-title {
        font-size: 32px;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 10px;
        text-align: left;
    }

    .formules-subtitle {
        font-size: 16px;
        color: #333;
        margin-bottom: 40px;
        text-align: left;
        max-width: 900px;
    }

    .formules-grid {
        display: flex;
        justify-content: space-between;
        gap: 30px;
    }

    .formule-item {
        flex: 1;
        text-align: left;
    }

    .formule-item img {
        width: 100%;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .formule-item h3 {
        font-size: 22px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .formule-item p {
        font-size: 15px;
        color: #333;
        line-height: 1.5;
        margin-bottom: 20px;
    }

    .btn-blue {
        background: #1e3a8a;
        color: white;
        padding: 14px 30px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        display: inline-block;
        margin-top: 20px;
        text-align: center;
    }

    .formules-button-wrapper {
        text-align: center;
        margin-top: 20px;
    }

    /* ==== RESPONSIVE ==== */
    @media (max-width: 600px) {
        .formules-grid {
            flex-direction: column;
        }

        .formule-item img {
            width: 100%;
        }

        .btn-blue {
            width: 90%;
        }
    }
</style>

<div class="formules-block">

    <!-- TITRE -->
    <h2 class="formules-title">Nos formules et outils clés</h2>

    <!-- SOUS-TITRE -->
    <p class="formules-subtitle">
        Chaque offre est pensée pour simplifier votre quotidien professionnel dès le lancement de votre entreprise.
    </p>

    <!-- GRID 3 COLONNES -->
    <div class="formules-grid">

        <!-- 1 -->
        <div class="formule-item">
            <img src="{{ asset('images/3184458.webp') }}" alt="Site vitrine harmonieux">
            <h3>Site vitrine harmonieux</h3>
            <p>
                Une présence en ligne soignée et percutante pour présenter vos prestations et attirer vos premiers clients.
Votre visibilité est renforcée grâce à un accompagnement publicitaire sur les réseaux sociaux,
permettant de toucher rapidement les personnes qui recherchent vos services — avec des offres ajustées à vos besoins.
            </p>
        </div>

        <!-- 2 -->
        <div class="formule-item">
            <img src="{{ asset('images/4841691.webp') }}" alt="Gestion et facturation">
            <h3>Gestion et facturation</h3>
            <p>
                Générez facilement des devis et envoyez automatiquement des factures professionnelles après chaque paiement sécurisé.
            </p>
        </div>

        <!-- 3 -->
        <div class="formule-item">
            <img src="{{ asset('images/7439135.webp') }}" alt="Communication automatisée">
            <h3>Communication automatisée</h3>
            <p>
                Recevez et traitez vos messages facilement avec envoi d'emails automatiques configurés pour rassurer vos prospects.
            </p>
        </div>

    </div>

    <!-- BOUTON -->
    <div class="formules-button-wrapper">
        <a href="{{ route('tarifs') }}" class="btn-blue">Consulter nos tarifs</a>
    </div>

</div>

<!-- ==== BLOC GRIS FULL WIDTH ==== -->
<style>
    .bloc-gris-full {
        width: 100%;
        background: #f2f2f2;
        padding: 60px 30px;
        text-align: center;
    }

    .bloc-gris-full h2 {
        font-size: 32px;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 20px;
    }

    .bloc-gris-full p {
        font-size: 17px;
        color: #333;
        max-width: 900px;
        margin: 0 auto;
        line-height: 1.6;
    }

    @media (max-width: 600px) {
        .bloc-gris-full h2 {
            font-size: 26px;
        }
        .bloc-gris-full p {
            font-size: 15px;
        }
    }
</style>

<div class="bloc-gris-full">
    <h2>Une gestion simplifiée au quotidien</h2>

    <p>
        En centralisant vos demandes clients, vos devis et vos encaissements directement via votre boîte mail,
        vous gagnez un temps précieux pour vous consacrer pleinement au développement de votre métier.
    </p>
</div>


<!-- ==== BLOC IMAGE + TEXTE FULL WIDTH ==== -->
<style>
    .double-block {
        width: 100%;
        background: #ffffff;
        padding: 60px 40px;
    }

    .double-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
        margin-bottom: 60px;
    }

    .double-row img {
        width: 100%;
        max-width: 450px;
        border-radius: 10px;
    }

    .double-text {
        flex: 1;
        text-align: left;
    }

    .double-text h2 {
        font-size: 32px;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 15px;
    }

    .double-text p {
        font-size: 17px;
        color: #333;
        line-height: 1.6;
        max-width: 600px;
        margin-bottom: 20px;
    }

    .btn-blue {
        background: #1e3a8a;
        color: white;
        padding: 12px 26px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        display: inline-block;
        margin-top: 10px;
    }

    /* ==== RESPONSIVE ==== */
    @media (max-width: 600px) {
        .double-row {
            flex-direction: column;
            text-align: center;
        }

        .double-text {
            text-align: center;
        }

        .double-text h2 {
            font-size: 26px;
        }

        .double-text p {
            font-size: 15px;
        }

        .btn-blue {
            width: 90%;
        }

        .double-row img {
            max-width: 100%;
        }
    }
</style>

<div class="double-block">

    <!-- ==== LIGNE 1 : IMAGE GAUCHE / TEXTE DROITE ==== -->
    <div class="double-row">
        <img src="{{ asset('images/14466702.webp') }}" alt="Accompagnement A à Z">

        <div class="double-text">
            <h2>Un accompagnement de A à Z</h2>
            <p>
                Dès la réception de votre message, nous échangeons par téléphone pour comprendre précisément vos besoins.
                Infortom conçoit votre site sur mesure et fait des points d'étape réguliers pour valider chaque détail
                visuel et fonctionnel avant toute mise en ligne.
            </p>
        </div>
    </div>

    <!-- ==== LIGNE 2 : TEXTE GAUCHE / IMAGE DROITE ==== -->
    <div class="double-row">
        <div class="double-text">
            <h2>Le pack tout-en-un pour auto-entrepreneurs</h2>
            <p>
                Plus qu’un simple site vitrine, profitez d’une véritable boîte à outils commerciale :
formulaires sur mesure, réponses automatiques, création de devis rapides, liens de paiement sécurisés…
Et désormais, un accompagnement publicitaire complet sur les réseaux sociaux, avec des campagnes ciblées
Facebook, Instagram ou Google, à des tarifs adaptés à votre activité et à votre budget.
            </p>

            <!-- BOUTON AJOUTÉ ICI -->
            <a href="{{ route('contact') }}" class="btn-blue">Écrivez-nous aujourd’hui</a>
        </div>

        <img src="{{ asset('images/5583965.webp') }}" alt="Pack auto-entrepreneurs">
    </div>

</div>

<!-- ==== PETITE BARRE NOIRE FULL WIDTH ==== -->
<style>
    .mini-footer {
        width: 100%;
        background: #000000;
        padding: 12px 25px;
        color: #888888;
        font-size: 14px;
        text-align: left;
    }
</style>

<div class="mini-footer">
    © 2026 infortom
</div>

@endsection