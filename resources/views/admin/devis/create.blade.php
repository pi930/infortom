@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Créer un devis</h2>

    <form action="{{ route('admin.devis.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nom du client</label>
            <input type="text" name="client_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email du client</label>
            <input type="email" name="client_email" class="form-control" required>
        </div>

        <hr>

        <h4>Prestations</h4>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="items[]" value="deplacement" id="deplacement">
            <label class="form-check-label" for="deplacement">
                Déplacement / Dépannage — 60 €
            </label>
        </div>

        <h4 class="mt-4">Matériel</h4>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="items[]" value="ssd" id="ssd">
            <label class="form-check-label" for="ssd">
                Disque dur SSD — 60 €
            </label>
        </div>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="items[]" value="carte_son" id="carte_son">
            <label class="form-check-label" for="carte_son">
                Carte son — 60 €
            </label>
        </div>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="items[]" value="carte_reseau" id="carte_reseau">
            <label class="form-check-label" for="carte_reseau">
                Carte réseau — 60 €
            </label>
        </div>

        <h4 class="mt-4">Sites web</h4>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="items[]" value="blog" id="blog">
            <label class="form-check-label" for="blog">
                Site vitrine / Blog — 250 €
            </label>
        </div>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="items[]" value="entreprise" id="entreprise">
            <label class="form-check-label" for="entreprise">
                Site d'entreprise — 500 €
            </label>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="items[]" value="commercial" id="commercial">
            <label class="form-check-label" for="commercial">
                Site commercial — 1000 €
            </label>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Générer le devis</button>

    </form>
</div>
@endsection
