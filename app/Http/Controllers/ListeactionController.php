<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Processuse;
use App\Models\Objectif;
use App\Models\Risque;
use App\Models\Cause;
use App\Models\Rejet;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\Suivi_amelioration;
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

class ListeactionController extends Controller
{
    public function index_ap()
    {
        $actions = Action::join('postes', 'actions.poste_id', 'postes.id')
                        ->join('risques', 'actions.risque_id', 'risques.id')
                        ->join('processuses', 'risques.processus_id', 'processuses.id')
                        ->where('actions.type', 'preventive')
                        ->where('risques.statut', 'valider')
                        ->where('risques.page', 'risk')
                        ->select('actions.*', 'processuses.nom as processus', 'risques.nom as risque','postes.nom as poste')
                        ->get();

        foreach ($actions as $action) {
            $suivi = Suivi_action::where('action_id', $action->id)->first();

            if ($suivi) {
                $action->suivi = 'oui';
                $action->date_action = $suivi->date_action;
                $action->date_suivi = $suivi->date_suivi;
                $action->commentaire = $suivi->commentaire;
                $action->efficacite = $suivi->efficacite;
            } else {
                $action->suivi = 'non';
            }
        }

        $postes = Poste::where('occupe', 'oui')->get();

        return view('liste.actionpreventive', ['actions' => $actions,  'postes' => $postes ]); // Utilisez $action->id au lieu de $request->id
    }

    public function index_ac()
    {
        $actions = Action::join('risques', 'actions.risque_id', 'risques.id')
                        ->join('processuses', 'risques.processus_id', 'processuses.id')
                        ->join('postes', 'postes.id', 'actions.poste_id')
                        ->where('actions.type', 'corrective')
                        ->where('risques.statut', 'valider')
                        ->where('risques.page', 'risk')
                        ->select('actions.*', 'processuses.nom as processus', 'risques.nom as risque', 'postes.nom as poste')
                        ->get();
        $postes = Poste::where('occupe', 'oui')->get();

        return view('liste.actioncorrective', ['actions' => $actions, 'postes' => $postes]);
    }

    public function actionc_modif(Request $request)
    {

        $action = $request->input('action');
        $poste_id = $request->input('poste_id');

        $rech = Action::find($request->id);

        if ($rech)
        {
            $rech->action = $action;
            $rech->poste_id = $poste_id;
            $rech->update();

            $his = new Historique_action();
            $his->nom_formulaire = 'Liste des Actions correctives';
            $his->nom_action = 'Mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()->back()->with('success', 'Mise à jour éffectuée.');
        }

        return redirect()->back()->with('error', 'Echec de la mise à jour.');
    }

    public function actionp_modif(Request $request)
    {

        $action = $request->input('action');
        $poste_id = $request->input('poste_id');

        $rech = Action::find($request->id);

        if ($rech)
        {
            $rech->action = $action;
            $rech->poste_id = $poste_id;
            $rech->update();

            $his = new Historique_action();
            $his->nom_formulaire = 'Liste des Actions Preventives';
            $his->nom_action = 'Mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()->back()->with('success', 'Mise à jour éffectuée.');
        }

        return redirect()->back()->with('error', 'Echec de la mise à jour.');
    }

}
