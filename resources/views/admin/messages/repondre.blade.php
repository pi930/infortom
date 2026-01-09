@extends('layouts.app')

@section('content')
<h2>Répondre au message</h2>

<form action="{{ route('admin.messages.envoyerReponse', $message->id) }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Votre réponse :</label>
        <textarea name="reponse" class="form-control" rows="5" required></textarea>
    </div>

    <button type="submit" class="btn btn-success mt-3">Envoyer la réponse</button>
</form>
@endsection

