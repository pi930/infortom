@extends('layouts.app')

@section('content')

<h2 style="font-size: 32px; margin-bottom: 30px;">Votre espace utilisateur</h2>

{{-- Messages flash --}}
@if(session('success'))
    <div style="padding: 10px; background: #d4edda; border: 1px solid #c3e6cb; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="padding: 10px; background: #f8d7da; border: 1px solid #f5c6cb; margin-bottom: 20px;">
        {{ session('error') }}
    </div>
@endif


{{-- ========================= --}}
{{-- SECTION : MESSAGES        --}}
{{-- ========================= --}}

<h3 style="margin-bottom: 20px;">Vos messages envoyés</h3>

@if($messages->isEmpty())
    <p>Aucun message pour le moment.</p>
@else
    <ul>
        @foreach($messages as $message)
            <li>
                <strong>{{ $message->subject }}</strong><br>
                {{ $message->message }}<br>

                @if($message->reponse)
                    <em>Réponse de l’admin : {{ $message->reponse }}</em>
                @endif

                <hr>
            </li>
        @endforeach
    </ul>
@endif



{{-- ========================= --}}
{{-- SECTION : DEVIS           --}}
{{-- ========================= --}}

<h3 style="margin-top: 40px;">Vos devis</h3>

@if(auth()->user()->devis->isEmpty())
    <p>Aucun devis pour le moment.</p>
@else
    <ul>
        @foreach(auth()->user()->devis as $devis)
            <li>
                <a href="{{ route('user.devis.show', $devis->id) }}">
                    Devis #{{ $devis->id }} — {{ $devis->total_ttc }} €
                </a>
            </li>
        @endforeach
    </ul>
@endif
@if(session('panier_total'))
    <a href="{{ route('panier.show') }}" class="btn btn-success">
        Voir / Accepter le devis
    </a>
@endif




{{-- ========================= --}}
{{-- SECTION : RENDEZ-VOUS     --}}
{{-- ========================= --}}

<h3 style="margin-top: 40px;">Votre rendez-vous</h3>

{{-- Navigation entre semaines --}}
<div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
    <form method="GET" action="{{ route('user.dashboard') }}">
        <input type="hidden" name="week" value="{{ $weekOffset - 1 }}">
        <button style="padding: 5px 10px;">← Semaine précédente</button>
    </form>

    <div>
        Semaine du <strong>{{ $startOfWeek->format('d/m/Y') }}</strong>
        au <strong>{{ $endOfWeek->format('d/m/Y') }}</strong>
    </div>

    <form method="GET" action="{{ route('user.dashboard') }}">
        <input type="hidden" name="week" value="{{ $weekOffset + 1 }}">
        <button style="padding: 5px 10px;">Semaine suivante →</button>
    </form>
</div>


{{-- Si l'utilisateur a déjà un rendez-vous --}}
@if($myRdv)
    <div style="padding: 15px; border: 1px solid #b8daff; background: #d1ecf1; margin-bottom: 20px;">
        <strong>Vous avez un rendez-vous :</strong><br>
        Le {{ $myRdv->date->format('d/m/Y') }}<br>
        De {{ $myRdv->date->format('H:i') }} à {{ $myRdv->date->copy()->addHours(2)->format('H:i') }}<br>
        Adresse : {{ $myRdv->rue }}, {{ $myRdv->ville }}<br>
        Téléphone : {{ $myRdv->telephone }}

        <form action="{{ route('user.rendezvous.destroy', $myRdv->id) }}" method="POST" style="margin-top: 10px;">
            @csrf
            @method('DELETE')
            <button style="padding: 5px 10px; background: #dc3545; color: white; border: none;">
                Supprimer ce rendez-vous
            </button>
        </form>
    </div>

@else

    {{-- Sinon : afficher les propositions --}}
    <h4>Propositions de rendez-vous disponibles</h4>

    @if(count($propositions) === 0)
        <p>Aucun créneau disponible pour cette semaine.</p>
    @else
        <div style="display: flex; flex-wrap: wrap; gap: 15px;">

            @foreach($propositions as $date)
                <div style="border: 1px solid #ccc; padding: 15px; width: 250px;">
                    <strong>{{ $date->translatedFormat('l d/m') }}</strong><br>
                    {{ $date->format('H:i') }} - {{ $date->copy()->addHours(2)->format('H:i') }}

                    <form action="{{ route('user.rendezvous.select') }}" method="POST" style="margin-top: 10px;">
                        @csrf
                        <input type="hidden" name="date" value="{{ $date }}">
                        <button style="padding: 5px 10px; background: #28a745; color: white; border: none;">
                            Choisir ce créneau
                        </button>
                    </form>
                </div>
            @endforeach

        </div>
    @endif

@endif

@endsection
