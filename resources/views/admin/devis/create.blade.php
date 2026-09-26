@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Créer un devis</h2>

    <form action="{{ route('admin.devis.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nom du client</label>
            <input type="text" name="client_name" class="form-control"
                   value="{{ $client_name ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label>Email du client</label>
            <input type="email" name="client_email" class="form-control"
                   value="{{ $client_email ?? '' }}" required>
        </div>

        <hr>

        <h4>Prestations</h4>

        <!-- Dépannage -->
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="items[]" value="depannage" id="depannage">
            <label class="form-check-label" for="depannage">
                Dépannage — 60 €
            </label>
        </div>

        <!-- Site internet -->
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="items[]" value="site_internet" id="site_internet">
            <label class="form-check-label" for="site_internet">
                Site internet — 200 €
            </label>
        </div>
        <!-- Campagne publicitaire -->
<div class="form-check mb-2">
    <input class="form-check-input" type="checkbox" name="items[]" value="campagne_pub" id="campagne_pub">
    <label class="form-check-label" for="campagne_pub">
        Campagne publicitaire — 100 €
    </label>
</div>


        <!-- Nom de domaine -->
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="items[]" value="nom_de_domaine" id="nom_de_domaine">
            <label class="form-check-label" for="nom_de_domaine">
                Nom de domaine — 6 €
            </label>
        </div>

        <hr>

        <h4 class="mt-4">Ajout personnalisé</h4>

        <div class="mb-3">
            <label>Nom personnalisé</label>
            <input type="text" name="custom_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Montant personnalisé (€)</label>
            <input type="number" name="custom_amount" class="form-control" step="0.01">
        </div>

        <button type="submit" class="btn btn-success mt-4">
            Envoyer le devis au client
        </button>

    </form>
</div>
@endsection
