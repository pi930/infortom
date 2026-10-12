@extends('layouts.admin')

@section('title', 'Liste des utilisateurs')

@section('content')
<div class="container">

    <div class="table-responsive">
        <table class="table table-bordered bg-white shadow-sm align-middle" style="min-width: 700px;">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Coordonnées</th>
                    <th>Créé le</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name ?? '—' }}</td>
                        <td style="word-break: break-word;">{{ $user->email }}</td>

                        <td>
                            @if($user->coordonnee)
                                <small>
                                    <strong>Téléphone :</strong> {{ $user->coordonnee->telephone ?? '—' }}<br>
                                    <strong>Rue :</strong> {{ $user->coordonnee->rue ?? '—' }}<br>
                                    <strong>Code postal :</strong> {{ $user->coordonnee->code_postal ?? '—' }}<br>
                                    <strong>Ville :</strong> {{ $user->coordonnee->ville ?? '—' }}
                                </small>
                            @else
                                —
                            @endif
                        </td>

                        <td>{{ $user->created_at->format('d/m/Y') }}</td>

                        <td>
                            <a href="{{ route('admin.user.show', $user->id) }}" class="btn btn-info btn-sm">
                                Voir
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection