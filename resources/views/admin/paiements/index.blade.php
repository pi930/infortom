@extends('layouts.admin')

@section('content')

<h2 style="text-align:center; margin-bottom:30px;">Tableau de bord des paiements</h2>

<div style="max-width:1000px; margin:auto;">

    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:#f5f5f5;">
                <th style="padding:10px; border-bottom:1px solid #ddd;">Devis</th>
                <th style="padding:10px; border-bottom:1px solid #ddd;">Client</th>
                <th style="padding:10px; border-bottom:1px solid #ddd;">Montant TTC</th>
                <th style="padding:10px; border-bottom:1px solid #ddd;">Type</th>
                <th style="padding:10px; border-bottom:1px solid #ddd;">Date</th>
                <th style="padding:10px; border-bottom:1px solid #ddd;">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($paiements as $p)
                <tr>
                    <td style="padding:10px;">#{{ $p->id }}</td>
                    <td style="padding:10px;">{{ $p->client_name }}<br><small>{{ $p->client_email }}</small></td>
                    <td style="padding:10px;">{{ $p->total_ttc }} €</td>
                    <td style="padding:10px;">
                        @if($p->paiement_type === 'total')
                            <span style="color:green; font-weight:bold;">Total</span>
                        @else
                            <span style="color:orange; font-weight:bold;">Acompte</span>
                        @endif
                    </td>
                    <td style="padding:10px;">{{ $p->paiement_date->format('d/m/Y H:i') }}</td>
                    <td style="padding:10px;">
                        <a href="{{ route('admin.devis.show', $p->id) }}" 
                           style="color:#007bff; text-decoration:underline;">
                            Voir le devis
                        </a>
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

