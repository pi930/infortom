@extends('layouts.admin')

@section('title', 'Liste des utilisateurs')

@section('content')
<div class="container">

    <h2>Liste des utilisateurs</h2>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Coordonnées</th>
                <th>Date de création</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name ?? '—' }}</td>
                    <td>{{ $user->email }}</td>

                    <td>
                        @if($user->coordonnee)
                            <strong>Téléphone :</strong> {{ $user->coordonnee->telephone ?? '—' }}<br>
                            <strong>Rue :</strong> {{ $user->coordonnee->rue ?? '—' }}<br>
                            <strong>Code postal :</strong> {{ $user->coordonnee->code_postal ?? '—' }}<br>
                            <strong>Ville :</strong> {{ $user->coordonnee->ville ?? '—' }}<br>
                        @else
                            —
                        @endif
                    </td>

                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
