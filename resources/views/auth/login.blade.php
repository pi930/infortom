@extends('layouts.app')

@section('content')

<h2 style="text-align:center; margin-bottom:30px;">Connexion</h2>

<form action="{{ route('login') }}" method="POST" style="max-width:400px; margin:auto;">
    @csrf

    <label>Email :</label>
    <input type="email" name="email" required style="width:100%; padding:10px; margin-bottom:15px;">

    <label>Mot de passe :</label>

    <div style="position:relative; margin-bottom:15px;">
        <input type="password" id="password" name="password"
               required
               style="width:100%; padding:10px 40px 10px 10px;">

        <!-- Icône œil -->
        <span onclick="togglePassword()"
              style="position:absolute; right:10px; top:50%; transform:translateY(-50%);
                     cursor:pointer; font-size:18px; user-select:none;">
            👁️
        </span>
    </div>

    <!-- Lien mot de passe oublié -->
    <a href="{{ route('password.request') }}"
   style="display:block; margin-bottom:20px; color:#3f51b5; text-decoration:none;">
    Mot de passe oublié ?
</a>


    <button type="submit"
            style="padding:12px 25px; background:#3f51b5; color:white; border:none; border-radius:6px;">
        Se connecter
    </button>
</form>

<!-- Script pour afficher/masquer le mot de passe -->
<script>
function togglePassword() {
    const input = document.getElementById("password");
    input.type = input.type === "password" ? "text" : "password";
}
</script>

@endsection

