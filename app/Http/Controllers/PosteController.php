<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Events\NotificationAcorrective;
use App\Events\NotificationApreventive;
use App\Events\NotificationAnon;
use App\Events\NotificationProcessus;
use App\Events\NotificationRisque;

use App\Models\Processuse;
use App\Models\Objectif;
use App\Models\Risque;
use App\Models\Cause;
use App\Models\Rejet;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\Pdf_file;
use App\Models\Pdf_file_processus;
use App\Models\User;
use App\Models\Historique_action;
use App\Models\Poste;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Twilio\Rest\Client;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PosteController extends Controller
{
    public function index_liste_poste()
    {
        $postes = Poste::all();

        return view('liste.poste',['postes' => $postes]);
    }

    public function index_add_poste_traitement(Request $request)
    {
        $nom = $request->input('nom');

        foreach ($nom as $nom) {
            $poste = new Poste();
            $poste->nom = $nom;
            $poste->occupe = 'non';
            $poste->save();
        }

        if ($poste) {

            $his = new Historique_action();
            $his->nom_formulaire = 'Nouveau Poste';
            $his->nom_action = 'Ajouter';
            $his->user_id = Auth::user()->id;
            $his->save();

            return back()
                ->with('success', 'Enregistrement éffectuée.');
        }
    }

    public function get_post_user() 
    {
        $postes = Poste::all(); // Récupération de tous les postes depuis la base de données
        return response()->json(['postes' => $postes]);
    }

    public function index_modif_poste_traitement(Request $request)
    {
        $rech = Poste::where('id', $request->poste_id)->first();
        
        if ($rech) {

            $rech->nom = $request->nom;
            $rech->update();

            $his = new Historique_action();
            $his->nom_formulaire = 'Liste des Postes';
            $his->nom_action = 'Mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()
                ->back()
                ->with('success', 'Mise à jour éffectuée.');
        }
    }

    public function poste_delete($id)
    {
        $delete1 = poste::where('id', '=', $id)->delete();

        if($delete1)
        {
            return redirect()->back()->with('success', 'Suppression éffectuée.');
        }

        return redirect()->back()->with('error', 'Echec de la Suppression.');
    }
}
