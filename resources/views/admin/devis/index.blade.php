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
                    <th>Statut</th>
                    <th>Paiement</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($devis as $d)
                <tr>
                    <td>#{{ $d->id }}</td>

                    <td>{{ $d->client_name }}</td>

                    <td>{{ $d->client_email }}</td>

                    <td><strong>{{ $d->total_ttc }} €</strong></td>

                    <td>
                        @if($d->statut === 'payé')
                            <span class="badge bg-success">Payé</span>
                        @else
                            <span class="badge bg-warning text-dark">En attente</span>
                        @endif
                    </td>

                    <td>
                        @if($d->paiement_type === 'total')
                            <span class="badge bg-success">Total payé</span>

                        @elseif($d->paiement_type === 'acompte')
                            <span class="badge bg-info">Acompte payé</span>

                        @elseif($d->paiement_type === 'reste')
                            <span class="badge bg-primary">Reste payé</span>

                        @else
                            <span class="badge bg-secondary">Aucun paiement</span>
                        @endif
                    </td>

                    <td>
    {{-- Voir le devis --}}
    <a href="{{ route('admin.devis.show', $d->id) }}" class="btn btn-sm btn-primary mb-1">
        Voir
    </a>

    {{-- Petit devis (≤ 100 €) : envoi du lien de paiement total --}}
    @if(!$d->acompte_possible && $d->paiement_type === null)
        <a href="{{ route('admin.devis.sendEmail', $d->id) }}" class="btn btn-sm btn-secondary mb-1">
            {{ $d->email_sent ? 'Renvoyer' : 'Envoyer' }} le lien de paiement ({{ $d->total_ttc }} €)
        </a>
    @endif

    {{-- Devis avec acompte : l'acompte part automatiquement à la création --}}
    @if($d->acompte_possible && $d->paiement_type === null)
        <span class="badge bg-warning text-dark">Acompte en attente</span>
    @endif

    {{-- Acompte payé : on affiche le badge + bouton d'envoi du reste --}}
    @if($d->paiement_type === 'acompte')
        <span class="badge bg-info">Acompte payé</span>
        <a href="{{ route('admin.devis.sendReste', $d->id) }}" class="btn btn-sm btn-info mb-1">
            {{ $d->reste_email_sent ? 'Renvoyer' : 'Envoyer' }} le reste par mail ({{ $d->reste_a_payer }} €)
        </a>
    @endif

    {{-- Tout est réglé --}}
    @if(in_array($d->paiement_type, ['total', 'reste']))
        <span class="badge bg-success">Soldé</span>
    @endif

    {{-- Email initial --}}
    @if($d->email_sent)
        <span class="badge bg-success">Email envoyé</span>
    @else
        <span class="badge bg-danger">Email non envoyé</span>
    @endif
</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection


