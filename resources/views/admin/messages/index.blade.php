@extends('layouts.admin')

@section('title', 'Messages reçus')

@section('content')

@if($messages->isEmpty())
    <p>Aucun message pour le moment.</p>
@else
    @foreach($messages as $msg)
        <div class="bg-white p-3 mb-3 shadow-sm rounded">

            <strong>{{ $msg->name }} ({{ $msg->email }})</strong><br>
<strong>Adresse postale :</strong> {{ $msg->client_address ?: 'Non renseignée' }}<br>
            <strong>Sujet :</strong> {{ $msg->subject }}

            <div class="mt-2 p-2 bg-light border-start border-3 rounded">
                <strong>Message :</strong>
                <p class="mb-0" style="word-break: break-word;">{{ $msg->message }}</p>
            </div>

            <small class="text-muted d-block mt-2">Reçu le : {{ $msg->created_at->format('d/m/Y H:i') }}</small>

            <hr>

            <div class="d-flex flex-column flex-sm-row gap-2">
                <a href="{{ route('admin.messages.repondre', $msg->id) }}" class="btn btn-secondary">
    Répondre
</a>
                <a href="{{ route('admin.rendezvous.index', [
                    'name' => $msg->name,
                    'email' => $msg->email,
                    'subject' => $msg->subject,
                    'message' => $msg->message,
                    'phone' => $msg->phone
                ]) }}" class="btn btn-success">
                    Prendre rendez-vous
                </a>

                <a href="{{ route('admin.devis.create', [
                    'client_name' => $msg->name,
                    'client_email' => $msg->email,
                    'client_address' => $msg->client_address,
                ]) }}" class="btn btn-primary">
                    Faire un devis
                </a>
                <form action="{{ route('admin.messages.destroy', $msg->id) }}"
      method="POST"
      onsubmit="return confirm('Voulez-vous vraiment supprimer ce message ?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger w-100">
        Supprimer
    </button>
</form>
            </div>
            

        </div>
    @endforeach
@endif

@endsection