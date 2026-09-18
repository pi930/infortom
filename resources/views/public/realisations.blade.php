@extends('layouts.app')

@section('content')

<!-- ==== BLOC GRIS FULL WIDTH ==== -->
<style>
    .real-grey {
        width: 100%;
        background: #f2f2f2;
        padding: 60px 40px;
        text-align: left;
    }

    .real-grey h1 {
        font-size: 34px;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 20px;
    }

    .real-grey p {
        font-size: 17px;
        color: #333;
        max-width: 900px;
        line-height: 1.6;
    }
</style>

<div class="real-grey">
    <h1>Nos réalisations web</h1>

    <p>
        Chez infortom à Cannes, nous concevons des sites internet modernes et clés en main pour les auto‑entrepreneurs
        qui souhaitent se faire connaître rapidement. De la prise de rendez‑vous aux paiements en ligne sécurisés,
        en passant par l'envoi automatique de devis et factures par e‑mail, chaque projet allie harmonie visuelle,
        simplicité d'utilisation et tarifs accessibles.
    </p>
</div>
<!-- ==== BLOC BLANC FULL WIDTH ==== -->
<style>
    .real-white {
        width: 100%;
        background: #ffffff;
        padding: 60px 40px;
        text-align: left;
    }

    .real-white h2 {
        font-size: 30px;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 20px;
    }

    .real-white p {
        font-size: 17px;
        color: #333;
        max-width: 900px;
        line-height: 1.6;
    }
</style>

<div class="real-white">
    <h2>Projets récents créés pour nos clients</h2>

    <p>
        Découvrez nos réalisations phares telles que Careandnet et Thomaservice. Pour chacun de ces professionnels,
        nous avons mis en place une interface élégante et intuitive, une communication directe par e‑mail,
        la réservation en ligne ainsi qu'un système automatisé de facturation et de paiement.
    </p>
</div>
<!-- ==== BLOC IMAGES FULL WIDTH ==== -->
<style>
    .real-grid {
        width: 100%;
        background: #ffffff;
        padding: 40px 20px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .real-grid img {
        width: 100%;
        height: 230px;
        object-fit: cover;
        border-radius: 8px;
    }
</style>

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

<!-- ==== BLOC BLEU FULL WIDTH ==== -->
<style>
    .cta-blue-full {
        width: 100%;
        background: #1e3a8a;
        padding: 60px 40px;
        text-align: center;
        color: white;
    }

    .cta-blue-full h2 {
        font-size: 34px;
        font-weight: 800;
        margin-bottom: 20px;
        color: white;
    }

    .cta-blue-full p {
        font-size: 17px;
        max-width: 900px;
        margin: 0 auto 35px auto;
        line-height: 1.6;
        color: #f8f8f8;
    }

    .cta-blue-full .cta-white-btn {
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
        .cta-blue-full h2 {
            font-size: 26px;
        }
        .cta-blue-full p {
            font-size: 15px;
        }
        .cta-blue-full .cta-white-btn {
            width: 90%;
        }
    }
</style>

<div class="cta-blue-full">
    <h2>Prêt à lancer votre site internet ?</h2>

    <p>
        Vous lancez votre activité ou souhaitez donner un nouvel élan à votre présence en ligne ?
        Contactez infortom dès aujourd'hui par téléphone ou via notre formulaire pour échanger sur vos besoins
        et obtenir une solution adaptée à votre budget.
    </p>

    <a href="{{ route('services') }}" class="cta-white-btn">Découvrir nos services</a>
</div>
<!-- ==== PETITE BARRE NOIRE ==== -->
<style>
    .mini-footer {
        width: 100%;
        background: #000;
        padding: 12px 25px;
        color: #888;
        font-size: 14px;
        text-align: left;
    }
</style>

<div class="mini-footer">
    © 2026 infortom
</div>

@endsection