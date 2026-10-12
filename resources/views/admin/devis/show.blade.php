@section('content')
<div class="container">

    <p><strong>Client :</strong> {{ $devis->client_name }}</p>
    <p><strong>Email :</strong> {{ $devis->client_email }}</p>

    <hr>

    {{-- ... ton @php $labels ... et la liste des prestations inchangés ... --}}

    <h3>Total TTC : {{ $devis->total_ttc }} €</h3>
    <p><strong>Total HT :</strong> {{ $devis->total_ht }} €</p>
    <p><strong>TVA :</strong> {{ $devis->tva }} €</p>

    {{-- ... bloc acompte inchangé ... --}}

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
        <button type="submit" class="btn btn-primary w-100 w-md-auto">
            Importer le contrat signé
        </button>
    </form>

</div>
@endsection