@extends('layouts.admin')

@section('title', 'Paramètres du compte')

@section('content')
<div class="container" style="max-width: 600px; margin-left: 0;">

    <form action="{{ route('admin.user.settings.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', auth()->user()->name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', auth()->user()->email) }}">
        </div>

        <div class="d-grid d-md-block mt-3">
            <button class="btn btn-primary">Mettre à jour</button>
        </div>

    </form>

</div>
@endsection


