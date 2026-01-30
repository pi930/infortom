@extends('layouts.app')

@section('content')

<h2 style="font-size: 32px; margin-bottom: 30px;">Tableau de bord administrateur</h2>

<h3 style="margin-bottom: 20px;">Messages reçus</h3>

@if($messages->isEmpty())
    <p>Aucun message pour le moment.</p>
@else
    @foreach($messages as $msg)
        <div style="background: white; padding: 15px; margin-bottom: 15px; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

            <strong>{{ $msg->name }} ({{ $msg->email }})</strong><br>
            <strong>Sujet :</strong> {{ $msg->subject }}<br>

            <strong>Message :</strong>
            <p>{{ $msg->message }}</p>

            <small>Reçu le : {{ $msg->created_at->format('d/m/Y H:i') }}</small>

            <div style="margin-top: 10px;">
                <a href="{{ route('admin.messages.repondre', $msg->id) }}" class="btn btn-primary">
                    Répondre
                </a>
            </div>

        </div>
    @endforeach
@endif
<h3 style="margin-top: 40px; margin-bottom: 20px;">Devis des utilisateurs</h3>

@if($devis->isEmpty())
    <p>Aucun devis pour le moment.</p>
@else
    <table class="table table-bordered" style="background:white;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Email</th>
                <th>Services</th>
                <th>Total</th>
                <th>Statut</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
            @foreach($devis as $d)
                <tr>
                    <td>{{ $d->id }}</td>
                    <td>{{ $d->client_name }}</td>
                    <td>{{ $d->client_email }}</td>
                    <td>{{ implode(', ', $d->items) }}</td>
                    <td>{{ $d->total_ttc }} €</td>
                    <td>
                        @if($d->statut === 'payé')
                            <span class="badge bg-success">Payé</span>
                        @elseif($d->statut === 'accepté')
                            <span class="badge bg-primary">Accepté</span>
                        @else
                            <span class="badge bg-secondary">En attente</span>
                        @endif
                    </td>
                    <td>{{ $d->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<li><a href="{{ route('admin.devis.create') }}">Créer un devis</a></li>
<tr>
    <td>
        <a href="{{ route('admin.rendezvous.index') }}" class="btn btn-primary">
            Gestion des rendez-vous
        </a>
    </td>
</tr>


@endsection


