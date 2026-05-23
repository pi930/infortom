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
            <li style="margin-bottom:20px;">

                <strong>{{ $message->subject }}</strong><br>
                {{ $message->message }}<br>

                {{-- Réponse admin --}}
                @if($message->reponse)
                    <div style="margin-top:10px; padding:10px; background:#eef5ff; border-left:4px solid #3f51b5;">
                        <strong>Réponse de l’admin :</strong><br>
                        {{ $message->reponse }}
                    </div>

                    {{-- Bouton pour afficher le formulaire --}}
                    <button onclick="toggleReplyForm({{ $message->id }})"
                            style="margin-top:10px; padding:6px 12px; background:#3f51b5; color:white; border:none; border-radius:5px; cursor:pointer;">
                        Répondre
                    </button>

                    {{-- Formulaire caché --}}
                    <form id="reply-form-{{ $message->id }}"
                          action="{{ route('user.messages.reply', $message->id) }}"
                          method="POST"
                          style="display:none; margin-top:15px; border:1px solid #ddd; padding:15px; border-radius:8px; background:#f9f9f9;">
                        
                        @csrf

                        <label style="font-weight:bold;">Votre réponse :</label>
                        <textarea name="reply"
                                  required
                                  style="width:100%; height:90px; padding:10px; margin-top:5px; border-radius:6px; border:1px solid #ccc;"></textarea>

                        <button type="submit"
                                style="margin-top:10px; padding:8px 15px; background:#28a745; color:white; border:none; border-radius:5px;">
                            Envoyer la réponse
                        </button>
                    </form>
                @endif

                {{-- Réponse utilisateur (si elle existe) --}}
                @if($message->user_reply)
                    <div style="margin-top:10px; padding:10px; background:#e8f5e9; border-left:4px solid #28a745;">
                        <strong>Votre réponse :</strong><br>
                        {{ $message->user_reply }}
                    </div>
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
@if(!$devisRecu)
    <p style="color:#b71c1c; font-weight:bold;">
        Vous devez d'abord recevoir un devis avant de pouvoir réserver un rendez-vous.
    </p>
@else

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
@endif
<script>
function toggleReplyForm(id) {
    const form = document.getElementById('reply-form-' + id);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>


@endsection
