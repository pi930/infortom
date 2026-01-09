<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\RendezVous;
use Carbon\Carbon;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Semaine relative (0 = cette semaine)
        $weekOffset = (int) $request->query('week', 0);

        $baseDate = Carbon::now()->addWeeks($weekOffset);
        $startOfWeek = $baseDate->copy()->startOfWeek();
        $endOfWeek   = $baseDate->copy()->endOfWeek();

        // Génération des propositions automatiques
        $propositions = $this->generatePropositions($startOfWeek);

        // Rendez-vous de l'utilisateur (basé sur son téléphone)
        $myRdv = RendezVous::where('user_id', $user->id)->first();



        return view('user.dashboard', [
            'devis'        => $user->devis,
            'messages'     => $user->messages,
            'propositions' => $propositions,
            'myRdv'        => $myRdv,
            'startOfWeek'  => $startOfWeek,
            'endOfWeek'    => $endOfWeek,
            'weekOffset'   => $weekOffset,
        ]);
    }

 private function generatePropositions(Carbon $startOfWeek)
{
    $propositions = collect();
    $max = 9;

    // 4 créneaux de 2h par jour
    $hours = [8, 10, 14, 16];

    for ($d = 0; $d < 7; $d++) {
        $day = $startOfWeek->copy()->addDays($d)->startOfDay();

        foreach ($hours as $h) {
            if ($propositions->count() >= $max) {
                break 2; // sortir des deux boucles
            }

            $date = $day->copy()->setTime($h, 0);

            // Vérifier si un rendez-vous existe déjà
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

    // Empêcher un utilisateur d'avoir plusieurs RDV
    $already = RendezVous::where('user_id', $user->id)->exists();
    if ($already) {
        return back()->with('error', 'Vous avez déjà un rendez-vous.');
    }

    // Vérifier si le créneau est encore libre
    if (RendezVous::where('date', $date)->exists()) {
        return back()->with('error', 'Ce créneau vient d\'être pris.');
    }
    if (!$user->phone) {
    return back()->with('error', 'Veuillez ajouter votre numéro de téléphone dans votre profil avant de réserver un rendez-vous.');
}


    // Création du rendez-vous
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

    // Sécurité : l'utilisateur ne peut supprimer que son RDV
    if ($rdv->user_id !== $user->id) {
        abort(403);
    }

    $rdv->delete();

    return back()->with('success', 'Rendez-vous supprimé.');
}

}


