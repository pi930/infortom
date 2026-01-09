@extends('layouts.app')

@section('content')
<div style="text-align: center; margin-top: 40px;">

    @guest
        <a href="{{ route('login') }}"
           style="padding: 12px 25px; background: #3f51b5; color: white; border-radius: 6px; text-decoration: none; margin-right: 15px;">
            Connexion
        </a>

        <a href="{{ route('register') }}"
           style="padding: 12px 25px; background: #4caf50; color: white; border-radius: 6px; text-decoration: none;">
            Inscription
        </a>
    @endguest

    @auth
        <a href="{{ route('user.dashboard') }}"
           style="padding: 12px 25px; background: #ff9800; color: white; border-radius: 6px; text-decoration: none;">
            Tableau de bord
        </a>
    @endauth
    

</div>

    <section class="hero" style="padding: 80px 0; background: #f5f7fa;">
        <div class="container" style="max-width: 900px; margin: auto; text-align: center;">
            <h1 style="font-size: 42px; font-weight: bold; margin-bottom: 20px;">
                Bienvenue chez Infortom
            </h1>

            <p style="font-size: 18px; color: #555; margin-bottom: 30px;">
                Votre partenaire informatique pour le dépannage, l’assistance, le développement web
                et les solutions numériques adaptées à vos besoins.
            </p>
            <div style="margin-bottom: 30px;">

            <a href="{{ route('contact') }}"
               style="padding: 12px 25px; background: #007bff; color: white; border-radius: 6px; text-decoration: none; font-size: 18px;">
                Demander un devis
            </a>
        </div>
    </section>

    <section class="services" style="padding: 60px 0;">
        <div class="container" style="max-width: 1000px; margin: auto;">
            <h2 style="text-align: center; font-size: 32px; margin-bottom: 40px;">
                Mes services
            </h2>

            <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">

                <div style="width: 300px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <h3 style="font-size: 22px; margin-bottom: 10px;">Dépannage informatique</h3>
                    <p style="color: #555;">Intervention rapide pour résoudre vos problèmes matériels et logiciels.</p>
                </div>


