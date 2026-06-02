<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RendezVous;
use Carbon\Carbon;

class UserRendezVousController extends Controller
{
    public function index()
{
    $user = auth()->user();

    $devisRecu = $user->devis()->exists();
    $myRdv = RendezVous::where('user_id', $user->id)->first();

    $propositions = [];
    if ($devisRecu && !$myRdv) {
        $propositions = $this->generatePropositions(Carbon::now()->startOfWeek());
    }

    return view('user.rendezvous.index', [
        'devisRecu'     => $devisRecu,
        'myRdv'         => $myRdv,
        'propositions'  => $propositions
    ]);
}



    private function generatePropositions(Carbon $startOfWeek)
    {
        $propositions = collect();
        $max = 9;
        $hours = [8, 10, 14, 16];

        for ($d = 0; $d < 7; $d++) {
            $day = $startOfWeek->copy()->addDays($d)->startOfDay();

            foreach ($hours as $h) {
                if ($propositions->count() >= $max) break 2;

                $date = $day->copy()->setTime($h, 0);

                if (!RendezVous::where('date', $date)->exists()) {
                    $propositions->push($date);
                }
            }
        }

        return $propositions;
    }


    public function select(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $user = auth()->user();
        $date = Carbon::parse($request->date);

        // Un seul RDV par utilisateur
        if (RendezVous::where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Vous avez déjà un rendez-vous.');
        }

        // Créneau déjà pris ?
        if (RendezVous::where('date', $date)->exists()) {
            return back()->with('error', 'Ce créneau vient d\'être pris.');
        }

        // Téléphone obligatoire
        if (!$user->phone) {
            return back()->with('error', 'Veuillez ajouter votre numéro de téléphone dans votre profil avant de réserver un rendez-vous.');
        }

        // Création du RDV
        RendezVous::create([
            'date'      => $date,
            'nom'       => $user->name,
            'telephone' => $user->phone,
            'rue'       => $user->rue ?? '',
            'ville'     => $user->ville ?? '',
            'user_id'   => $user->id,
        ]);

        return back()->with('success', 'Rendez-vous réservé.');
    }


    public function destroy($id)
    {
        $user = auth()->user();
        $rdv = RendezVous::findOrFail($id);

        if ($rdv->user_id !== $user->id) {
            abort(403);
        }

        $rdv->delete();

        return back()->with('success', 'Rendez-vous supprimé.');
    }
}

