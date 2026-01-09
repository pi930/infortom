<?php  

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\RendezVous;
use App\Models\User;


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
    ]);

    $dateHeure = Carbon::parse($request->date . ' ' . $request->heure);

    // Mise à jour du téléphone dans users.phone
    $user = User::find($request->user_id);
    $user->phone = $request->telephone;
    $user->save();

    RendezVous::create([
        'date'      => $dateHeure,
        'nom'       => $request->nom,
        'rue'       => $request->rue,
        'ville'     => $request->ville,
        'telephone' => $request->telephone,
        'user_id'   => $request->user_id,
    ]);

    return back()->with('success', 'Rendez-vous ajouté');
}


    public function destroy($id)
    {
        RendezVous::findOrFail($id)->delete();
        return back()->with('success', 'Rendez-vous supprimé');
    }
}

