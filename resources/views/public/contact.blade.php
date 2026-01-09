@extends('layouts.app')

@section('content')

<h2 style="margin-bottom: 20px;">Contactez-nous</h2>

@if(session('success'))
    <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('contact.send') }}" 
      style="max-width: 600px; margin: auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
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

@endsection

