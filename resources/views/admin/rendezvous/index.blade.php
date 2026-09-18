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


    <table class="table table-bordered text-center align-middle">
    <thead class="table-dark">
        <tr>
            <th>Heures</th>
            @for ($i = 0; $i < 7; $i++)
                <th>{{ $startOfWeek->copy()->addDays($i)->format('l d/m') }}</th>
            @endfor
        </tr>
    </thead>

    <tbody>
        @for ($h = 8; $h <= 18; $h++)
            <tr>
                <th class="table-secondary">{{ $h }}h - {{ $h+2 }}h</th>

                @for ($d = 0; $d < 7; $d++)
                    @php
                        $date = $startOfWeek->copy()->addDays($d)->setTime($h, 0);
                        $rdv = $rendezvous->firstWhere('date', $date);
                    @endphp

                   @if ($rdv)
    <td class="{{ $rdv->confirmed ? 'bg-primary text-white' : 'bg-danger text-white' }}">
        <strong>{{ $rdv->nom }}</strong><br>
        {{ $rdv->rue }} - {{ $rdv->ville }}<br>
        {{ $rdv->telephone }}

        @if($rdv->confirmed)
            <div class="mt-2 badge bg-success">Rendez-vous confirmé</div>
        @else
            <div class="mt-2 badge bg-warning">En attente de confirmation</div>
        @endif

        @if($rdv->email_sent)
            <div class="mt-2 badge bg-info">Email envoyé</div>
        @else
            <div class="mt-2 badge bg-danger">Email NON envoyé</div>
        @endif

        <form action="{{ route('admin.rendezvous.destroy', $rdv->id) }}" method="POST" class="mt-2">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-light">Supprimer</button>
        </form>
    </td>
@endif

                @endfor
            </tr>
        @endfor
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

