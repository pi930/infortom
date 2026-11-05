@extends('layouts.app')

@section('title', "L'exception au quotidien - Infortom | Qualité et service impeccable")
@section('description', "Découvrez Infortom : nos engagements, la qualité et un service impeccable, adaptés à vos besoins à chaque étape.")

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
    <h1>L’exception au quotidien</h1>

    <p>
        C'est ici que commence notre aventure. Apprenez à connaître notre entreprise et ce que nous faisons.
        Nos engagements : la qualité et un service impeccable. Rejoignez-nous pour grandir et atteindre
        des sommets, ensemble. Nous sommes heureux que vous soyez ici pour faire partie de notre histoire.
    </p>
</div>

<!-- ==== BLOC BLANC FULL WIDTH + CARTES ==== -->
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

    .project-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        margin-top: 35px;
    }

    .project-card {
        flex: 1 1 280px;
        max-width: 420px;
        background: #f2f2f2;
        border-radius: 12px;
        padding: 28px;
        box-sizing: border-box;
        border-left: 5px solid #1e3a8a;
    }

    .project-card h3 {
        font-size: 22px;
        font-weight: 800;
        color: #1e3a8a;
        margin: 0 0 10px 0;
    }

    .project-card .project-desc {
        font-size: 16px;
        color: #333;
        line-height: 1.6;
        margin: 0;
    }

    @media (max-width: 600px) {
        .real-white,
        .real-grey {
            padding: 40px 20px;
        }

        .project-card {
            max-width: 100%;
        }
    }
</style>

<div class="real-white">
    <h2>Histoires racontées en pixels</h2>

    <div class="project-cards">

        <div class="project-card">
            <h3>Histoires racontées en pixels</h3>
            <p class="project-desc">
                Nous sommes fiers de notre adaptabilité et de notre engagement envers l’excellence dans tous
                les aspects de notre service. Découvrez ce que nous avons à offrir et voyez comment nous pouvons
                contribuer à votre réussite.
            </p>
        </div>

        <div class="project-card">
            <h3>Histoires racontées en pixels</h3>
            <p class="project-desc">
                Nous nous adaptons à vos besoins et nous nous engageons à vous offrir un service de qualité
                à chaque étape. Découvrez nos solutions et voyez comment nous pouvons vous aider à atteindre
                vos objectifs.
            </p>
        </div>

        <div class="project-card">
            <h3>Histoires racontées en pixels</h3>
            <p class="project-desc">
                On est fiers de notre capacité à nous adapter et de notre engagement à vous offrir un service
                au top. Découvrez ce qu’on peut vous apporter et voyez comment on peut vous aider à réussir.
            </p>
        </div>

    </div>
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
        .cta-blue-full h2 { font-size: 26px; }
        .cta-blue-full p { font-size: 15px; }
        .cta-blue-full .cta-white-btn { width: 90%; }
    }
</style>

<div class="cta-blue-full">
    <h2>Rejoignez-nous</h2>

    <p>
        Nous sommes heureux que vous soyez ici pour faire partie de notre histoire.
        Contactez-nous dès aujourd'hui pour échanger sur vos besoins.
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