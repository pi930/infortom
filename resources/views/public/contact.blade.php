@extends('layouts.app')

@section('content')

<style>
    .contact-header {
        width: 100%;
        background: #ffffff;
        padding: 50px 40px;
        text-align: left;
    }

    .contact-header h1 {
        font-size: 34px;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 20px;
    }

    .contact-header p {
        font-size: 17px;
        color: #333;
        max-width: 900px;
        line-height: 1.6;
    }

    .contact-container {
        display: flex;
        gap: 40px;
        padding: 50px 40px;
        background: #ffffff;
    }

    .contact-left {
        flex: 1;
        text-align: left;
    }

    .contact-left img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .contact-left h2 {
        font-size: 26px;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 10px;
    }

    .contact-left p {
        font-size: 16px;
        color: #333;
        line-height: 1.5;
        margin-bottom: 10px;
    }

    .contact-right {
        flex: 1;
        background: #f7f7f7;
        padding: 30px;
        border-radius: 10px;
    }

    .contact-right h2 {
        font-size: 26px;
        font-weight: 800;
        color: #1e3a8a;
        margin-bottom: 20px;
    }

    .contact-right label {
        font-size: 15px;
        font-weight: 600;
        color: #333;
        display: block;
        margin-bottom: 6px;
    }

    .contact-right input,
    .contact-right textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 15px;
    }

    .contact-right textarea {
        height: 140px;
        resize: none;
    }

    .contact-btn {
        background: #1e3a8a;
        color: white;
        padding: 14px 30px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    @media (max-width: 768px) {
        .contact-container {
            flex-direction: column;
        }
    }
</style>

<!-- ==== BANDEAU BLANC ==== -->
<div class="contact-header">
    <h1>Contactez Infortom</h1>

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

        <h2>E-mail</h2>
        <p>t.pierrard.131.198@outlook.fr</p>

        <h2>Réseaux sociaux</h2>

<a href="https://www.facebook.com/share/18s1hCsu3W/" 
   target="_blank" 
   style="display:flex; align-items:center; gap:10px;">

    <img src="{{ asset('images/logo-facebook.jpg') }}" 
         alt="Facebook Infortom" 
         style="width:32px; height:32px;">

    <span style="font-size:16px; color:#1e3a8a; font-weight:600;">
        Facebook
    </span>
</a>

    </div>

    <!-- ==== COLONNE DROITE : FORMULAIRE ==== -->
    <div class="contact-right">
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
