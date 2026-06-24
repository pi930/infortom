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
    <input class="form-control mb-3" type="text" name="client_name"
           value="{{ $config->data['client_name'] ?? $devis->client_name }}" required>

    <label>Email du client</label>
    <input class="form-control mb-4" type="email" name="client_email"
           value="{{ $config->data['client_email'] ?? $devis->client_email }}" required>



    {{-- ============================
         FORMULAIRE SITE WEB
    ============================= --}}
    @if($service === 'site')
        <h3>Configuration du site web</h3>

        <label>Nom du site</label>
        <input class="form-control mb-3" type="text" name="site_name"
               value="{{ $config->data['site_name'] ?? '' }}">

        <label>Identifiant admin</label>
        <input class="form-control mb-3" type="text" name="site_login"
               value="{{ $config->data['site_login'] ?? '' }}">

        <label>Mot de passe admin</label>
        <input class="form-control mb-3" type="text" name="site_password"
               value="{{ $config->data['site_password'] ?? '' }}">

        <h4 class="mt-4">Emails du site</h4>

        @php
            $emails = $config->data['emails'] ?? [''];
        @endphp

        <div id="email-container">
            @foreach($emails as $email)
                <input class="form-control mb-2" type="email" name="emails[]" value="{{ $email }}">
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mb-4" onclick="addEmail()">+ Ajouter une adresse email</button>

        <h4 class="mt-4">Accès GitHub</h4>

        <label>Identifiant GitHub</label>
        <input class="form-control mb-3" type="text" name="github_login"
               value="{{ $config->data['github_login'] ?? '' }}">

        <label>Mot de passe GitHub</label>
        <input class="form-control mb-3" type="text" name="github_password"
               value="{{ $config->data['github_password'] ?? '' }}">
    @endif



    {{-- ============================
         FORMULAIRE ACTIVE DIRECTORY
    ============================= --}}
    @if($service === 'ad')
        <h3>Configuration Active Directory</h3>

        <h4>Email principal AD</h4>

        <label>Identifiant</label>
        <input class="form-control mb-3" type="text" name="ad_main_login"
               value="{{ $config->data['ad_main_login'] ?? '' }}">

        <label>Mot de passe</label>
        <input class="form-control mb-3" type="text" name="ad_main_password"
               value="{{ $config->data['ad_main_password'] ?? '' }}">

        <h4 class="mt-4">Emails supplémentaires AD</h4>

        @php
            $ad_emails = $config->data['ad_emails'] ?? [''];
        @endphp

        <div id="ad-email-container">
            @foreach($ad_emails as $email)
                <input class="form-control mb-2" type="email" name="ad_emails[]" value="{{ $email }}">
            @endforeach
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

