@extends('layouts.admin')

@section('title', 'Créer un devis')

@section('content')
<div class="container">

    <form action="{{ route('admin.devis.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nom du client</label>
            <input type="text" name="client_name" class="form-control"
                   value="{{ $client_name ?? '' }}" required>
        </div>
        <div class="mb-3">
    <label class="form-label">Adresse postale du client</label>
    <textarea name="client_address" class="form-control" rows="3" required>{{ old('client_address', $client_address ?? '') }}</textarea>
</div>
        <div class="mb-3">
            <label class="form-label">Email du client</label>
            <input type="email" name="client_email" class="form-control"
                   value="{{ $client_email ?? '' }}" required>
        </div>

        <div class="form-check mb-3">
    <input
        class="form-check-input"
        type="checkbox"
        name="is_company"
        id="is_company"
        value="1"
        @checked(old('is_company', $is_company ?? false))
    >
    <label class="form-check-label" for="is_company">
        Vous êtes une entreprise
    </label>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('is_company');
    const fields = document.getElementById('company-fields');
    const companyName = document.getElementById('company_name');
    const companySiren = document.getElementById('company_siren');

    function toggleCompanyFields() {
        fields.classList.toggle('d-none', !checkbox.checked);
        companyName.required = checkbox.checked;
        companySiren.required = checkbox.checked;
    }

    checkbox.addEventListener('change', toggleCompanyFields);
    toggleCompanyFields();
});
</script>
<div id="company-fields"
     class="{{ old('is_company', $is_company ?? false) ? '' : 'd-none' }}">
    <div class="mb-3">
        <label for="company_name" class="form-label">Raison sociale</label>
        <input type="text" name="company_name" id="company_name"
               class="form-control"
               value="{{ old('company_name', $company_name ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="company_siren" class="form-label">SIREN</label>
        <input type="text" name="company_siren" id="company_siren"
               class="form-control" maxlength="9" inputmode="numeric"
               value="{{ old('company_siren', $company_siren ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="company_vat_number" class="form-label">
            Numéro de TVA intracommunautaire (facultatif)
        </label>
        <input type="text" name="company_vat_number" id="company_vat_number"
               class="form-control"
               value="{{ old('company_vat_number', $company_vat_number ?? '') }}">
    </div>
</div>
        <hr>

        <h4>Prestations</h4>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="items[]" value="depannage" id="depannage">
            <label class="form-check-label" for="depannage">Dépannage — 60 €</label>
        </div>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="items[]" value="site_internet" id="site_internet">
            <label class="form-check-label" for="site_internet">Site internet — 200 €</label>
        </div>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="items[]" value="campagne_pub" id="campagne_pub">
            <label class="form-check-label" for="campagne_pub">Campagne publicitaire — 100 €</label>
        </div>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="items[]" value="nom_de_domaine" id="nom_de_domaine">
            <label class="form-check-label" for="nom_de_domaine">Nom de domaine — 6 €</label>
        </div>

        <hr>

        <h4 class="mt-4">Ajout personnalisé</h4>

        <div class="mb-3">
            <label class="form-label">Nom personnalisé</label>
            <input type="text" name="custom_name" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Montant personnalisé (€)</label>
            <input type="number" name="custom_amount" class="form-control" step="0.01" inputmode="decimal">
        </div>

        <button type="submit" class="btn btn-success mt-3 w-100 w-md-auto">
            Envoyer le devis au client
        </button>

    </form>
</div>
@endsection