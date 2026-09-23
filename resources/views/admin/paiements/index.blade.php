@extends('layouts.admin')

@section('content')

<h2 style="text-align:center; margin-bottom:30px;">Tableau de bord des paiements</h2>

<div style="max-width:1000px; margin:auto;">

    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:#f5f5f5;">
                <th style="padding:10px;">Devis</th>
                <th style="padding:10px;">Client</th>
                <th style="padding:10px;">Montant</th>
                <th style="padding:10px;">Type</th>
                <th style="padding:10px;">Date</th>
                <th style="padding:10px;">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($paiements as $p)
                <tr>

                    <td style="padding:10px;">#{{ $p->id }}</td>

                    <td style="padding:10px;">
                        {{ $p->client_name }}<br>
                        <small>{{ $p->client_email }}</small>
                    </td>

                    <td style="padding:10px;">
                        <strong>{{ $p->total_ttc }} €</strong>
                    </td>

                    <td style="padding:10px;">
                        @if($p->paiement_type === 'total')
                            <span style="color:green; font-weight:bold;">Total</span>
                        @elseif($p->paiement_type === 'acompte')
                            <span style="color:orange; font-weight:bold;">Acompte</span>
                        @elseif($p->paiement_type === 'reste')
                            <span style="color:blue; font-weight:bold;">Reste payé</span>
                        @else
                            <span style="color:gray;">Inconnu</span>
                        @endif
                    </td>

                    <td style="padding:10px;">
                        {{ $p->paiement_date->format('d/m/Y H:i') }}
                    </td>

                    <td style="padding:10px;">

                        <a href="{{ route('admin.devis.show', $p->id) }}" style="color:#007bff;">
                            Voir le devis
                        </a><br>

                        <a href="{{ route('admin.facture.show', $p->id) }}" style="color:green;">
                            Voir la facture
                        </a><br>

                        <a href="{{ route('admin.service.config.form', $p->id) }}">
                            🛠️ Configurer le service
                        </a><br>

                        @php
                            $filename = "facture_{$p->paiement_type}_devis_{$p->id}.pdf";
                        @endphp

                        @if(Storage::exists("factures/$filename"))
                            <a href="{{ route('admin.facture.download', $p->id) }}" style="color:green;">
                                Télécharger la facture
                            </a>
                        @endif

                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:20px;">
                        Aucun paiement enregistré.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
