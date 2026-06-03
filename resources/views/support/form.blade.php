@extends('layouts.app')

@section('content')
<div style="max-width:600px;margin:auto;padding:20px;">
    <h2 style="text-align:center;margin-bottom:20px;">Contactez le support</h2>

    @if(session('success'))
        <div style="background:#d4edda;padding:10px;border-radius:5px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('support.send') }}">
        @csrf

        <label>Nom :</label>
        <input type="text" name="name" value="{{ $user->name }}" required
               style="width:100%;padding:10px;margin-bottom:15px;">

        <label>Email :</label>
        <input type="email" name="email" value="{{ $user->email }}" required
               style="width:100%;padding:10px;margin-bottom:15px;">

        <label>Sujet :</label>
        <input type="text" name="subject" required
               style="width:100%;padding:10px;margin-bottom:15px;">

        <label>Message :</label>
        <textarea name="message" rows="6" required
                  style="width:100%;padding:10px;margin-bottom:15px;"></textarea>

        <button type="submit"
                style="background:#007bff;color:white;padding:10px 20px;border:none;border-radius:5px;cursor:pointer;">
            Envoyer
        </button>
    </form>
</div>
@endsection

