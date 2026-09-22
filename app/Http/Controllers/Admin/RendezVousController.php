<?php  

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;



class RendezVousController extends Controller
{

public function index()
{
    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek   = Carbon::now()->endOfWeek();

    $rendezvous = RendezVous::whereBetween('date', [$startOfWeek, $endOfWeek])->get();
    $users = User::all();

    return view('admin.rendezvous.index', compact('rendezvous', 'startOfWeek', 'endOfWeek', 'users'));
}



public function store(Request $request)
{
    $request->validate([
        'date' => 'required|date',
        'heure' => 'required',
        'nom' => 'required',
        'rue' => 'required',
        'ville' => 'required',
        'telephone' => 'required',
        'user_id' => 'required|exists:users,id',
        'type' => 'required|string'
    ]);

    $dateHeure = Carbon::parse($request->date . ' ' . $request->heure);

    // Mise à jour du téléphone dans users.phone
    $user = User::find($request->user_id);
    $user->phone = $request->telephone;
    $user->save();

    // 🔥 Génération du lien Google Meet si nécessaire
    $meetLink = null;
    if ($request->type === 'google_meet') {
        $meetLink = "https://meet.google.com/lookup/INFORTOM-" . uniqid();
    }

    // Création du rendez-vous
    $rdv = RendezVous::create([
        'date'      => $dateHeure,
        'nom'       => $request->nom,
        'rue'       => $request->rue,
        'ville'     => $request->ville,
        'telephone' => $request->telephone,
        'user_id'   => $request->user_id,
        'confirmed' => false,
        'type'      => $request->type,
        'meet_link' => $meetLink
    ]);

    // 🔥 Lien de confirmation signé (sécurisé)
    $confirmationLink = URL::temporarySignedRoute(
        'admin.rendezvous.confirm',
        now()->addDays(2),
        ['id' => $rdv->id]
    );

    // 🔥 Texte spécifique selon le type
    if ($request->type === 'telephone') {
        $typeMessage = "Ce rendez-vous se déroulera par téléphone.\nNous vous appellerons au numéro indiqué.";
    } else {
        $typeMessage = "Ce rendez-vous se déroulera via Google Meet.\nVoici votre lien de réunion :\n\n$meetLink\n\nUn rappel vous sera envoyé après confirmation.";
    }

    // 🔥 Envoi du mail automatique
Mail::send([], [], function ($message) use ($user, $rdv, $confirmationLink, $typeMessage) {
    $message->to($user->email)
            ->subject('Confirmation de votre rendez-vous - Infortom')
            ->text("
Bonjour {$user->name},

Merci d'avoir pris rendez-vous avec Infortom.

📅 Date : {$rdv->date->format('d/m/Y à H:i')}
📍 Ville : {$rdv->ville}

$typeMessage

Pour confirmer votre rendez-vous, veuillez cliquer sur le lien ci-dessous :

$confirmationLink

Nous restons disponibles pour toute question.

Cordialement,
Infortom
06400 Cannes
");
});

// Si l’envoi ne plante pas → on marque comme envoyé
$rdv->email_sent = true;
$rdv->save();

    

    return back()->with('success', 'Rendez-vous ajouté et email envoyé au client.');
}


    public function destroy($id)
    {
        RendezVous::findOrFail($id)->delete();
        return back()->with('success', 'Rendez-vous supprimé');
    }
    public function confirm(Request $request, $id)
{
    if (! $request->hasValidSignature()) {
        abort(403, 'Lien de confirmation invalide ou expiré.');
    }

    $rdv = RendezVous::findOrFail($id);
    $rdv->confirmed = true;
    $rdv->save();

    return redirect()->route('home')
    ->with('success', 'Votre rendez-vous est confirmé !');


}


}

