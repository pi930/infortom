@extends('layouts.admin')

@section('title', 'Liste des devis')

@section('content')
<div class="container">

    <h2 class="mb-4">Liste des devis</h2>

    @if($devis->isEmpty())
        <p>Aucun devis pour le moment.</p>
    @else
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Email</th>
                    <th>Total TTC</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($devis as $d)
                    <tr>
                        <td>{{ $d->id }}</td>
                        <td>{{ $d->client_name }}</td>
                        <td>{{ $d->client_email }}</td>
                        <td>{{ $d->total_ttc }} €</td>
                        <td>{{ $d->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.devis.show', $d->id) }}" class="btn btn-sm btn-primary">
                                Voir
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection

