@extends('layouts.admin')

@section('title', 'Fiche utilisateur')

@section('content')

<h2 class="mb-4">Fiche utilisateur : {{ $user->name }}</h2>

{{-- ============================
     COORDONNÉES
============================ --}}
<h3>Coordonnées</h3>

@if($coordonnees)
    <p><strong>Nom :</strong> {{ $coordonnees->nom }}</p>
    <p><strong>Adresse :</strong> {{ $coordonnees->rue }}, {{ $coordonnees->code_postal }} {{ $coordonnees->ville }}</p>
    <p><strong>Téléphone :</strong> {{ $coordonnees->telephone }}</p>

    <a href="{{ route('admin.user.password.edit', $user->id) }}" class="btn btn-warning">
        Modifier le mot de passe
    </a>
@else
    <p>Aucune coordonnée enregistrée.</p>
@endif


<hr>

{{-- ============================
     MESSAGES
============================ --}}
<h3>Messages</h3>

@if($messages->count())
    <ul>
        @foreach($messages as $msg)
            <li>{{ $msg->message }} — <em>{{ $msg->created_at }}</em></li>
        @endforeach
    </ul>
@else
    <p>Aucun message.</p>
@endif

<hr>

{{-- ============================
     RENDEZ-VOUS
============================ --}}
<h3>Rendez-vous</h3>

@if($rendezvous->count())
    <ul>
        @foreach($rendezvous as $rdv)
            <li>
                {{ $rdv->date }} à {{ $rdv->heure }}
                <form action="{{ route('admin.rendezvous.delete', $rdv->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
@else
    <p>Aucun rendez-vous.</p>
@endif

<hr>

{{-- ============================
     DEVIS
============================ --}}
<h3>Devis</h3>

@if($devis->count())
    <ul>
        @foreach($devis as $d)
            <li>
                Devis #{{ $d->id }} — {{ $d->statut }}

                <form action="{{ route('admin.devis.delete', $d->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
@else
    <p>Aucun devis.</p>
@endif

<hr>

{{-- ============================
     CONFIGURATION SERVICE
============================ --}}
<h3>Configuration du service</h3>

@if($serviceConfig)
    <pre>{{ print_r($serviceConfig->data, true) }}</pre>
@else
    <p>Aucune configuration enregistrée.</p>
@endif

@endsection

