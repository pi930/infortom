@extends('layouts.admin')

@section('content')
<div class="container">

    <h2 class="mb-4">Planning des rendez-vous (semaine en cours)</h2>
@if(request()->has('name'))
<div class="alert alert-info p-3 mb-4">
    <h4>Client concerné</h4>

    <p><strong>Nom :</strong> {{ request('name') }}</p>
    <p><strong>Email :</strong> {{ request('email') }}</p>
    <p><strong>Sujet :</strong> {{ request('subject') }}</p>
    <p><strong>Message :</strong> {{ request('message') }}</p>

    <hr>

    <h5>Créer un rendez-vous pour ce client</h5>

    <form action="{{ route('admin.rendezvous.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col">
                <label>Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="col">
                <label>Heure</label>
                <select name="heure" class="form-control" required>
                    @for ($h = 8; $h <= 18; $h++)
                        <option value="{{ $h }}:00">{{ $h }}h</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" value="{{ request('name') }}" required>
            </div>

            <div class="col">
                <label>Téléphone</label>
                <input type="text" name="telephone" class="form-control" value="{{ request('phone') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Rue</label>
                <input type="text" name="rue" class="form-control" required>
            </div>

            <div class="col">
                <label>Ville</label>
                <input type="text" name="ville" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Type de rendez-vous</label>
            <select name="type" class="form-control" required>
                <option value="telephone">Par téléphone</option>
                <option value="google_meet">Par Google Meet</option>
            </select>
        </div>

        <input type="hidden" name="user_id" value="{{ $users->firstWhere('email', request('email'))->id ?? 1 }}">

        <button class="btn btn-primary">Envoyer le rendez-vous</button>
    </form>
</div>
@endif

    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

</div>


<h3 class="mt-5 mb-3">Liste des rendez-vous</h3>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Date</th>
            <th>Nom</th>
            <th>Ville</th>
            <th>Téléphone</th>
            <th>Type</th>
            <th>Lien Meet</th>
            <th>Confirmé</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($rendezvous as $rdv)
            <tr>
                <td>{{ $rdv->date->format('d/m/Y H:i') }}</td>
                <td>{{ $rdv->nom }}</td>
                <td>{{ $rdv->ville }}</td>
                <td>{{ $rdv->telephone }}</td>

                {{-- 🔥 Type de rendez-vous --}}
                <td>
                    @if($rdv->type === 'telephone')
                        📞 Téléphone
                    @else
                        🎥 Google Meet
                    @endif
                </td>

                {{-- 🔥 Lien Meet si Google Meet --}}
                <td>
                    @if($rdv->type === 'google_meet')
                        <a href="{{ $rdv->meet_link }}" target="_blank" class="btn btn-sm btn-info">
                            Ouvrir la réunion
                        </a>
                    @else
                        —
                    @endif
                </td>

                {{-- Confirmation --}}
                <td>
                    @if($rdv->confirmed)
                        <span class="badge bg-success">Confirmé</span>
                    @else
                        <span class="badge bg-warning">En attente</span>
                    @endif
                </td>

                <td>
                    <form action="{{ route('admin.rendezvous.destroy', $rdv->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


    <hr>

    <h3>Ajouter un rendez-vous</h3>

<form action="{{ route('admin.rendezvous.store') }}" method="POST" class="mt-3">
    @csrf

    <div class="row mb-3">
        <div class="col">
            <label>Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="col">
            <label>Heure (début)</label>
            <select name="heure" class="form-control" required>
                @for ($h = 8; $h <= 18; $h++)
                    <option value="{{ $h }}:00">{{ $h }}h</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="col">
            <label>Téléphone</label>
            <input type="text" name="telephone" class="form-control" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label>Rue</label>
            <input type="text" name="rue" class="form-control" required>
        </div>

        <div class="col">
            <label>Ville</label>
            <input type="text" name="ville" class="form-control" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label>Utilisateur concerné</label>
            <select name="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button class="btn btn-primary">Ajouter le rendez-vous</button>
</form>

</div>
@endsection

