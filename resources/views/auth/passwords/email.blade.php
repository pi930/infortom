@extends('layouts.app')

@section('content')
<div style="max-width:400px; margin:auto; margin-top:40px;">

    <h2 style="text-align:center; margin-bottom:20px;">Mot de passe oublié</h2>

    @if(session('status'))
        <div style="padding:10px; background:#d4edda; border:1px solid #c3e6cb; margin-bottom:15px;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <label>Email :</label>
        <input type="email" name="email" required
               style="width:100%; padding:10px; margin-bottom:15px;">

        <button type="submit"
                style="padding:12px 25px; background:#3f51b5; color:white; border:none; border-radius:6px; width:100%;">
            Envoyer le lien de réinitialisation
        </button>
    </form>

</div>
@endsection

