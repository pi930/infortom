@extends('layouts.admin')

@section('content')
<div class="container">

    <h2>Paramètres du compte</h2>

    <form action="{{ route('admin.user.settings.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control"
                   value="{{ auth()->user()->name }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ auth()->user()->email }}">
        </div>

        <button class="btn btn-primary mt-3">Mettre à jour</button>
    </form>

</div>
@endsection

