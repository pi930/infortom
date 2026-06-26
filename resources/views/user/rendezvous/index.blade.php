@extends('layouts.app')

@section('content')

<style>
.rdv-background {
    background-image: url('{{ asset('images/home-background.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 40px 0;
    position: relative;
}

/* Voile sombre */
.rdv-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.35);
    z-index: 1;
}

/* Contenu au-dessus du voile */
.rdv-background > .container {
    position: relative;
    z-index: 2;
}
</style>

<div class="rdv-background">
    <div class="container" style="max-width:800px; margin:auto;">

        <h2 style="text-align:center; font-size:28px; margin-bottom:30px; color:white;">
            Mes Rendez-vous
        </h2>

        {{-- 1. L'utilisateur n'a pas encore reçu de devis --}}
        @if(!$devisRecu)
            <div style="background:#ffecec; padding:20px; border-left:5px solid #ff4d4d; border-radius:6px;">
                <strong>Demandez un devis pour pouvoir prendre un rendez-vous.</strong>
            </div>

        @else

            {{-- 2. L'utilisateur a déjà un rendez-vous --}}
            @if($myRdv)
                <div style="background:#e8f7e8; padding:20px; border-left:5px solid #28a745; border-radius:6px;">
                    <h3 style="margin-bottom:10px;">Votre rendez-vous</h3>
                    <p><strong>Date :</strong> {{ $myRdv->date->format('d/m/Y') }}</p>
                    <p><strong>Heure :</strong> {{ $myRdv->date->format('H:i') }}</p>

                    <form action="{{ route('user.rendezvous.delete', $myRdv->id) }}" method="POST" style="margin-top:15px;">
                        @csrf
                        @method('DELETE')
                        <button style="background:#dc3545; color:white; padding:10px 15px; border:none; border-radius:5px;">
                            Supprimer le rendez-vous
                        </button>
                    </form>
                </div>

            {{-- 3. L'utilisateur n'a pas encore de rendez-vous → afficher les créneaux --}}
            @else
                <h3 style="margin-bottom:20px; color:white;">Créneaux disponibles</h3>

                @foreach($propositions as $slot)
                    <form action="{{ route('user.rendezvous.select') }}" method="POST" style="margin-bottom:15px;">
                        @csrf
                        <input type="hidden" name="date" value="{{ $slot }}">

                        <div style="background:white; padding:15px; border-radius:6px; box-shadow:0 2px 8px rgba(0,0,0,0.1); display:flex; justify-content:space-between; align-items:center;">
                            <span>{{ $slot->format('d/m/Y H:i') }}</span>

                            <button style="background:#007bff; color:white; padding:8px 12px; border:none; border-radius:5px;">
                                Réserver
                            </button>
                        </div>
                    </form>
                @endforeach
            @endif

        @endif

    </div>
</div>

<footer style="background:black; color:white; text-align:center; padding:20px; margin-top:50px;">
    <a href="/support" style="color:white; text-decoration:underline;">Contactez le support</a>
</footer>

@endsection
