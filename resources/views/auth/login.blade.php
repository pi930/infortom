@extends('layouts.app')

@section('content')

<style>
.login-background {
    background-image: url('{{ asset('images/home-background-new.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 60px 0;
    position: relative;
}

.login-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: transparent;
    z-index: 1;
}

.login-background > .container {
    position: relative;
    z-index: 2;
}
</style>

<div class="login-background">
    <div class="container" style="max-width:400px;margin:auto;">

        <h2 style="text-align:center; margin-bottom:30px; color:white;">
            Connexion
        </h2>

        <form action="{{ route('login') }}" method="POST"
              style="background:white;padding:25px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);">
            @csrf

            <label>Email :</label>
            <input type="email" name="email" required style="width:100%; padding:10px; margin-bottom:15px;">

            <label>Mot de passe :</label>

            <div style="position:relative; margin-bottom:15px;">
                <input type="password" id="password" name="password"
                       required
                       style="width:100%; padding:10px 40px 10px 10px;">

                <span onclick="togglePassword()"
                      style="position:absolute; right:10px; top:50%; transform:translateY(-50%);
                             cursor:pointer; font-size:18px; user-select:none;">
                    👁️
                </span>
            </div>

            <a href="{{ route('password.request') }}"
               style="display:block; margin-bottom:20px; color:#3f51b5; text-decoration:none;">
                Mot de passe oublié ?
            </a>

            <button type="submit"
                    style="padding:12px 25px; background:#3f51b5; color:white; border:none; border-radius:6px;">
                Se connecter
            </button>
        </form>

    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById("password");
    input.type = input.type === "password" ? "text" : "password";
}
</script>

@endsection

