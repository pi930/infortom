@extends('layouts.admin')

@section('title', 'Fiche utilisateur : ' . $user->name)

@section('content')
<div class="container">

    {{-- COORDONNÉES --}}
    <div class="bg-white p-3 mb-3 shadow-sm rounded">
        <h4>Coordonnées</h4>

        @if($coordonnees)
            <p class="mb-1"><strong>Nom :</strong> {{ $coordonnees->nom }}</p>
            <p class="mb-1"><strong>Adresse :</strong> {{ $coordonnees->rue }}, {{ $coordonnees->code_postal }} {{ $coordonnees->ville }}</p>
            <p class="mb-0"><strong>Téléphone :</strong> {{ $coordonnees->telephone }}</p>
        @else
            <p class="mb-0">Aucune coordonnée enregistrée.</p>
        @endif
    </div>

    {{-- MESSAGES --}}
    <div class="bg-white p-3 mb-3 shadow-sm rounded">
        <h4>Messages</h4>

        @if($messages->count())
            @foreach($messages as $msg)
                <div class="border-bottom py-2">
                    <div style="word-break: break-word;">{{ $msg->message }}</div>
                    <small class="text-muted">{{ $msg->created_at->format('d/m/Y H:i') }}</small>
                </div>
            @endforeach
        @else
            <p class="mb-0">Aucun message.</p>
        @endif
    </div>

    {{-- RENDEZ-VOUS --}}
    <div class="bg-white p-3 mb-3 shadow-sm rounded">
        <h4>Rendez-vous</h4>

        @if($rendezvous->count())
            @foreach($rendezvous as $rdv)
                <div class="d-flex justify-content-between align-items-center gap-2 border-bottom py-2">
                    <span>{{ $rdv->date->format('d/m/Y à H:i') }}</span>

                    <form action="{{ route('admin.rendezvous.destroy', $rdv->id) }}" method="POST"
                          onsubmit="return confirm('Supprimer ce rendez-vous ?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </div>
            @endforeach
        @else
            <p class="mb-0">Aucun rendez-vous.</p>
        @endif
    </div>

    {{-- DEVIS --}}
    <div class="bg-white p-3 mb-3 shadow-sm rounded">
        <h4>Devis</h4>

        @if($devis->count())
            @foreach($devis as $d)
                <div class="d-flex justify-content-between align-items-center gap-2 border-bottom py-2">
                    <span>Devis #{{ $d->id }} — {{ $d->statut }}</span>

                    @if($d->statut !== 'payé')
                        <form action="{{ route('admin.devis.delete', $d->id) }}" method="POST"
                              onsubmit="return confirm('Supprimer ce devis ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    @endif
                </div>
            @endforeach
        @else
            <p class="mb-0">Aucun devis.</p>
        @endif
    </div>

    {{-- CONFIGURATION SERVICE --}}
    <div class="bg-white p-3 mb-3 shadow-sm rounded">
        <h4>Configuration du service</h4>

        @if($serviceConfig)
            <pre class="bg-light p-2 rounded mb-0" style="white-space: pre-wrap; word-break: break-word; overflow-x: auto;">{{ print_r($serviceConfig->data, true) }}</pre>
        @else
            <p class="mb-0">Aucune configuration enregistrée.</p>
        @endif
    </div>

</div>
@endsection