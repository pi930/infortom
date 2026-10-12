@extends('layouts.admin')

@section('title', 'Tableau de bord des paiements')

@section('content')

<div class="table-responsive">
    <table class="table table-bordered bg-white shadow-sm align-middle" style="min-width: 750px;">
        <thead class="table-dark">
            <tr>
                <th>Devis</th>
                <th>Client</th>
                <th>Montant</th>
                <th>Type</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($paiements as $p)
                <tr>
                    <td>#{{ $p->id }}</td>

                    <td>
                        {{ $p->client_name }}<br>
                        <small class="text-muted">{{ $p->client_email }}</small>
                    </td>

                    <td><strong>{{ $p->total_ttc }} €</strong></td>

                    <td>
                        @if($p->paiement_type === 'total')
                            <span class="badge bg-success">Total</span>
                        @elseif($p->paiement_type === 'acompte')
                            <span class="badge bg-warning text-dark">Acompte</span>
                        @elseif($p->paiement_type === 'reste')
                            <span class="badge bg-primary">Reste payé</span>
                        @else
                            <span class="badge bg-secondary">Inconnu</span>
                        @endif
                    </td>

                    <td>{{ $p->paiement_date->format('d/m/Y H:i') }}</td>

                    <td>
                        @php
                            $filename = "facture_{$p->paiement_type}_devis_{$p->id}.pdf";
                        @endphp

                        <div class="d-flex flex-column gap-1">
                            <a href="{{ route('admin.devis.show', $p->id) }}" class="btn btn-sm btn-outline-primary">
                                Voir le devis
                            </a>

                            <a href="{{ route('admin.facture.show', $p->id) }}" class="btn btn-sm btn-outline-success">
                                Voir la facture
                            </a>

                            <a href="{{ route('admin.service.config.form', $p->id) }}" class="btn btn-sm btn-outline-secondary">
                                🛠️ Configurer le service
                            </a>

                            @if(Storage::exists("factures/$filename"))
                                <a href="{{ route('admin.facture.download', $p->id) }}" class="btn btn-sm btn-success">
                                    Télécharger la facture
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4">
                        Aucun paiement enregistré.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection