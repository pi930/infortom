@extends('layouts.app')

@section('content')

<style>
.contact-background {
    background-image: url('{{ asset('images/home-background-new.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 40px 0;
    position: relative;
}

/* Voile sombre */
.contact-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.35);
    z-index: 1;
}

/* Contenu au-dessus du voile */
.contact-background > .container {
    position: relative;
    z-index: 2;
}
</style>


<div class="contact-background">
    <div class="container" style="max-width: 700px; margin: auto;">

        <h2 style="margin-bottom: 20px; color:white; text-align:center;">
            Contactez-nous
        </h2>

        @if(session('success'))
            <p style="color: lightgreen; font-weight: bold; text-align:center;">
                {{ session('success') }}
            </p>
        @endif

        <form method="POST" action="{{ route('contact.send') }}" 
            style="background: white; padding: 25px; border-radius: 8px; 
                   box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            @csrf

            <label style="font-weight: bold;">Nom</label>
            <input type="text" name="name" required
                style="width: 100%; padding: 10px; border: none; outline: none;">
            <hr>

            <label style="font-weight: bold;">Email</label>
            <input type="email" name="email" required
                style="width: 100%; padding: 10px; border: none; outline: none;">
            <hr>

            <label style="font-weight: bold;">Sujet</label>
            <input type="text" name="subject" required
                style="width: 100%; padding: 10px; border: none; outline: none;">
            <hr>

            <label style="font-weight: bold;">Message</label>
            <textarea name="message" required rows="5"
                style="width: 100%; padding: 10px; border: none; outline: none; resize: vertical;"></textarea>
            <hr>

            <button type="submit"
                style="
                    width: 100%;
                    padding: 12px;
                    background: #3f51b5;
                    color: white;
                    font-size: 18px;
                    border: none;
                    border-radius: 6px;
                    cursor: pointer;
                    margin-top: 10px;
                    transition: 0.2s;
                "
                onmouseover="this.style.background='#303f9f'"
                onmouseout="this.style.background='#3f51b5'">
                Envoyer
            </button>

        </form>

    </div>
</div>

@endsection
