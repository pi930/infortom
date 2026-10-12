@extends('layouts.admin')

@section('title', 'Devis #'.$devis->id)

@section('content')
<div class="container">

    <p><strong>Client :</strong> {{ $devis->client_name }}</p>
    <p><strong>Email :</strong> {{ $devis->client_email }}</p>

    <hr>

    @php
        $labels = [
            'depannage'      => 'Dépannage — 60 €',
            'site_internet'  => 'Site internet — 200 €',
            'campagne_pub'   => 'Campagne publicitaire — 100 €',
            'nom_de_domaine' => 'Nom de domaine — 6 €',
        ];

        $items = is_array($devis->items) ? $devis->items : (json_decode($devis->items, true) ?? []);
    @endphp

    <h4>Prestations sélectionnées</h4>
    <ul>
        @foreach($items as $item)
            @if(str_starts_with($item, 'custom:'))
                @php
                    $parts = explode(':', $item);
                    $customName = $parts[1] ?? 'Nom personnalisé';
                    $customAmount = $parts[2] ?? 0;
                @endphp
                <li><strong>{{ $customName }}</strong> — {{ $customAmount }} €</li>
            @else
                <li>{{ $labels[$item] ?? $item }}</li>
            @endif
        @endforeach
    </ul>

    <h3>Total TTC : {{ $devis->total_ttc }} €</h3>
    <p><strong>Total HT :</strong> {{ $devis->total_ht }} €</p>
    <p><strong>TVA :</strong> {{ $devis->tva }} €</p>

    @if($devis->paiement_type === 'acompte')
        <p class="text-warning fw-bold">
            Acompte payé : {{ $devis->acompte }} €<br>
            Reste à payer : {{ $devis->reste_a_payer }} €
        </p>
    @endif

    <hr>

    <h3>Contrat généré</h3>
    <pre class="bg-white p-3 border rounded" style="white-space: pre-wrap; word-break: break-word; font-size: 15px;">{{ $devis->contrat }}</pre>

    <div class="d-flex flex-column flex-md-row gap-2 mt-3">
        <a href="{{ route('admin.devis.download', $devis->id) }}" class="btn btn-primary">
            Télécharger le contrat
        </a>

        @if($devis->contrat_pdf_both)
            <a href="{{ route('admin.devis.downloadBoth', $devis->id) }}" class="btn btn-primary">
                Télécharger le contrat signé des deux parties
            </a>
        @endif
    </div>

    <form action="{{ route('admin.devis.upload', $devis->id) }}"
          method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf
        <div class="mb-2">
            <input type="file" name="contrat_pdf" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">
            Importer le contrat signé
        </button>
    </form>

</div>
@endsection