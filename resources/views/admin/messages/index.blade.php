@extends('layouts.admin')

@section('title', 'Messages reçus')

@section('content')

<h2 class="mb-4">Messages reçus</h2>

@if($messages->isEmpty())
    <p>Aucun message pour le moment.</p>
@else
    @foreach($messages as $msg)
        <div class="bg-white p-3 mb-3 shadow-sm rounded">

            <strong>{{ $msg->name }} ({{ $msg->email }})</strong><br>
            <strong>Sujet :</strong> {{ $msg->subject }}

            <div class="mt-2 p-2 bg-light border-start border-3 rounded">
                <strong>Message :</strong>
                <p>{{ $msg->message }}</p>
            </div>

            <small class="text-muted">Reçu le : {{ $msg->created_at->format('d/m/Y H:i') }}</small>

            <hr>

           <a href="{{ route('admin.rendezvous.index', [
    'name' => $msg->name,
    'email' => $msg->email,
    'subject' => $msg->subject,
    'message' => $msg->message,
    'phone' => $msg->phone
]) }}" class="btn btn-success mt-2">
    Prendre rendez-vous
</a>


            <!-- Bouton faire un devis -->
            <a href="{{ route('admin.devis.create', [
                'client_name' => $msg->name,
                'client_email' => $msg->email
            ]) }}" class="btn btn-primary mt-2">
                Faire un devis
            </a>

        </div>
    @endforeach
@endif

@endsection
