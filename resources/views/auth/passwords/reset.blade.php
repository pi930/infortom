@extends('layouts.app')

@section('content')
<div style="max-width:400px; margin:auto; margin-top:40px;">

    <h2 style="text-align:center; margin-bottom:20px;">Nouveau mot de passe</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <label>Email :</label>
        <input type="email" name="email" value="{{ request()->email }}" required
               style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Nouveau mot de passe :</label>
        <div style="position:relative; margin-bottom:15px;">
            <input type="password" id="password" name="password" required
                   style="width:100%; padding:10px 40px 10px 10px;">
            <span onclick="togglePwd('password')"
                  style="position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer;">
                👁️
            </span>
        </div>

        <label>Confirmer le mot de passe :</label>
        <div style="position:relative; margin-bottom:15px;">
            <input type="password" id="password_confirmation" name="password_confirmation" required
                   style="width:100%; padding:10px 40px 10px 10px;">
            <span onclick="togglePwd('password_confirmation')"
                  style="position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer;">
                👁️
            </span>
        </div>

        <p id="error" style="color:#b71c1c; font-weight:bold; display:none;">
            Les mots de passe ne correspondent pas.
        </p>

        <button type="submit"
                onclick="return checkPasswords()"
                style="padding:12px 25px; background:#4caf50; color:white; border:none; border-radius:6px; width:100%;">
            Réinitialiser le mot de passe
        </button>
    </form>

</div>

<script>
function togglePwd(id) {
    const input = document.getElementById(id);
    input.type = input.type === "password" ? "text" : "password";
}

function checkPasswords() {
    const p1 = document.getElementById('password').value;
    const p2 = document.getElementById('password_confirmation').value;

    if (p1 !== p2) {
        document.getElementById('error').style.display = 'block';
        return false;
    }
    return true;
}
</script>

@endsection

