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
        'nom' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'rue' => 'required|string|max:255',
        'ville' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'type' => 'required|in:telephone,google_meet'
    ]);

    $dateHeure = Carbon::parse(
        $request->date . ' ' . $request->heure
    );

    // Recherche de l'utilisateur par email
    $user = User::where('email', $request->email)->first();

    // Nom utilisé dans les emails
    $userName = $user
        ? $user->name
        : $request->nom;

    // Mise à jour du téléphone si l'utilisateur existe
    if ($user) {
        $user->phone = $request->telephone;
        $user->save();
    }

    // Génération du lien Google Meet
    $meetLink = null;

    if ($request->type === 'google_meet') {
        $meetLink = 'https://meet.google.com/lookup/INFORTOM-' . uniqid();
    }

    // Création du rendez-vous
    $rdv = RendezVous::create([
        'date' => $dateHeure,
        'nom' => $request->nom,
        'email' => $request->email,
        'rue' => $request->rue,
        'ville' => $request->ville,
        'telephone' => $request->telephone,
        'user_id' => $user?->id,
        'confirmed' => false,
        'type' => $request->type,
        'meet_link' => $meetLink
    ]);

    // Lien signé de confirmation
    $confirmationLink = URL::temporarySignedRoute(
        'admin.rendezvous.confirm',
        now()->addDays(2),
        ['id' => $rdv->id]
    );

    // Texte spécifique selon le type
    if ($request->type === 'telephone') {

        $typeMessage = "Ce rendez-vous se déroulera par téléphone.\n"
            . "Nous vous appellerons au numéro indiqué.";

    } else {

        $typeMessage = "Ce rendez-vous se déroulera via Google Meet.\n\n"
            . "Lien de réunion :\n"
            . $meetLink
            . "\n\nUn rappel vous sera envoyé après confirmation.";
    }

    try {

        Mail::send([], [], function ($message) use (
            $request,
            $userName,
            $rdv,
            $confirmationLink,
            $typeMessage
        ) {

            $message->to($request->email)
                ->subject('Confirmation de votre rendez-vous - Infortom')
                ->text("
Bonjour {$userName},

Merci d'avoir pris rendez-vous avec Infortom.

Date : {$rdv->date->format('d/m/Y à H:i')}
Ville : {$rdv->ville}

{$typeMessage}

Pour confirmer votre rendez-vous :
{$confirmationLink}

Infortom
");
        });

        $rdv->email_sent = true;
        $rdv->save();

    } catch (\Exception $e) {

        \Log::error('Erreur mail : ' . $e->getMessage());

        return back()->with(
            'error',
            'Erreur lors de l\'envoi du mail : ' . $e->getMessage()
        );
    }

    return back()->with(
        'success',
        'Rendez-vous ajouté et email envoyé au client.'
    );
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

    // Peut être null maintenant
    $user = User::find($rdv->user_id);

    // Utiliser le nom du rendez-vous si aucun utilisateur associé
    $userName = $user
        ? $user->name
        : $rdv->nom;

    if ($rdv->confirmation_mail_sent) {
        return redirect()->route('home')
            ->with('success', 'Votre rendez-vous est déjà confirmé.');
    }

    $rdv->confirmed = true;
    $rdv->confirmation_mail_sent = true;
    $rdv->save();

    if ($rdv->type === 'telephone') {

        Mail::send([], [], function ($message) use ($userName, $rdv) {

            $message->to($rdv->email)
                ->subject('Rendez-vous confirmé - Infortom')
                ->text("
Bonjour {$userName},

Votre rendez-vous est désormais confirmé.

Date : {$rdv->date->format('d/m/Y à H:i')}
Type : Rendez-vous téléphonique

Nous vous contacterons au numéro :
{$rdv->telephone}

Merci de votre confiance.

Infortom
");
        });

    } else {

        Mail::send([], [], function ($message) use ($userName, $rdv) {

            $message->to($rdv->email)
                ->subject('Rendez-vous Google Meet confirmé - Infortom')
                ->text("
Bonjour {$userName},

Votre rendez-vous est désormais confirmé.

Date : {$rdv->date->format('d/m/Y à H:i')}
Type : Google Meet

Lien de connexion :
{$rdv->meet_link}

Merci de vous connecter quelques minutes avant l'heure prévue.

Infortom
");
        });
    }

    return redirect()->route('home')
        ->with('success', 'Votre rendez-vous est confirmé !');
}


}

