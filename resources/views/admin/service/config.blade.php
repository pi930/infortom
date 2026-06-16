@extends('layouts.admin')

@section('title', 'Configuration du service')

@section('content')

<h2 class="text-center mb-4">Configuration du service</h2>

<form method="POST" action="{{ route('admin.service.config.store', $devis->id) }}">
    @csrf

    {{-- ============================
         INFORMATIONS CLIENT
    ============================= --}}
    <h3>Informations du client</h3>

    <label>Nom du client</label>
    <input class="form-control mb-3" type="text" name="client_name" value="{{ $devis->client_name }}" required>

    <label>Email du client</label>
    <input class="form-control mb-4" type="email" name="client_email" value="{{ $devis->client_email }}" required>



    {{-- ============================
         FORMULAIRE SITE WEB
    ============================= --}}
    @if($service === 'site')
        <h3>Configuration du site web</h3>

        <label>Nom du site</label>
        <input class="form-control mb-3" type="text" name="site_name" required>

        <label>Identifiant admin</label>
        <input class="form-control mb-3" type="text" name="site_login" required>

        <label>Mot de passe admin</label>
        <input class="form-control mb-3" type="text" name="site_password" required>

        <h4 class="mt-4">Emails du site</h4>
        <div id="email-container">
            <input class="form-control mb-2" type="email" name="emails[]" placeholder="Adresse email">
        </div>

        <button type="button" class="btn btn-secondary mb-4" onclick="addEmail()">+ Ajouter une adresse email</button>

        <h4 class="mt-4">Accès GitHub</h4>

        <label>Identifiant GitHub</label>
        <input class="form-control mb-3" type="text" name="github_login" placeholder="Identifiant GitHub">

        <label>Mot de passe GitHub</label>
        <input class="form-control mb-3" type="text" name="github_password" placeholder="Mot de passe GitHub">
    @endif



    {{-- ============================
         FORMULAIRE ACTIVE DIRECTORY
    ============================= --}}
    @if($service === 'ad')
        <h3>Configuration Active Directory</h3>

        <h4>Email principal AD</h4>

        <label>Identifiant</label>
        <input class="form-control mb-3" type="text" name="ad_main_login" required>

        <label>Mot de passe</label>
        <input class="form-control mb-3" type="text" name="ad_main_password" required>

        <h4 class="mt-4">Emails supplémentaires AD</h4>

        <div id="ad-email-container">
            <input class="form-control mb-2" type="email" name="ad_emails[]" placeholder="Adresse email">
        </div>

        <button type="button" class="btn btn-secondary mb-4" onclick="addAdEmail()">+ Ajouter une adresse email</button>
    @endif

    <button type="submit" class="btn btn-primary mt-3">Envoyer au client</button>
</form>


<script>
function addEmail() {
    document.getElementById('email-container').insertAdjacentHTML(
        'beforeend',
        '<input class="form-control mb-2" type="email" name="emails[]" placeholder="Adresse email">'
    );
}

function addAdEmail() {
    document.getElementById('ad-email-container').insertAdjacentHTML(
        'beforeend',
        '<input class="form-control mb-2" type="email" name="ad_emails[]" placeholder="Adresse email">'
    );
}
</script>

@endsection



