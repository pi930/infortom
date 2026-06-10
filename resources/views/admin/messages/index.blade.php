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

            @if($msg->reponse)
                <div class="mt-3 p-2 bg-primary bg-opacity-10 border-start border-primary border-3 rounded">
                    <strong>Votre réponse :</strong>
                    <p>{{ $msg->reponse }}</p>
                </div>
            @endif

            <a href="{{ route('admin.messages.repondre', $msg->id) }}" class="btn btn-primary mt-3">
                Répondre
            </a>

        </div>
    @endforeach
@endif

@endsection

