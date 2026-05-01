@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Liste des utilisateurs</h2>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Date de création</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name ?? '—' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->coordonnee->telephone ?? '—' }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection


