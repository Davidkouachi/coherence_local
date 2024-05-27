<?php

namespace App\Http\Controllers;

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
use App\Models\Amelioration;
use App\Models\Suivi_amelioration;
use App\Models\Color_para;
use App\Models\Color_interval;


use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Twilio\Rest\Client;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use PDF;

/*use Barryvdh\DomPDF\Facade\Pdf;*/

class EtatController extends Controller
{
    public function index_etat_am(Request $request)
    {
        $am = Amelioration::find($request->id);

        $actionsData = [];

        if ($am) {

            $am->nbre_action = Suivi_amelioration::where('amelioration_id', '=', $am->id)->count();

            $suivi = Suivi_amelioration::where('amelioration_id', '=', $am->id)->get();

            $actionsData[$am->id] = [];

            foreach ($suivi as $suivis) {

                $action = Action::join('postes', 'actions.poste_id', 'postes.id')
                                ->join('risques', 'actions.risque_id', 'risques.id')
                                ->join('processuses', 'risques.processus_id', 'processuses.id')
                                ->where('actions.id', '=', $suivis->action_id)
                                ->select('actions.*', 'postes.nom as poste', 'processuses.nom as processus', 'risques.nom as risque')
                                ->first();

                if ($action) {
                    $actionsData[$am->id][] = [
                        'action' => $action->action,
                        'responsable' => $action->poste,
                        'delai' => $am->date_limite,
                        'date_action' => $suivis->date_action,
                        'date_suivi' => $suivis->date_suivi,
                        'statut' => $suivis->statut,
                        'processus' => $action->processus,
                        'risque' => $action->risque,
                        'commentaire' => $suivis->commentaire_am,
                        'efficacite' => $suivis->efficacite,
                    ];
                }

            }
        }

        return view('etat.amelioration', ['am' => $am, 'actionsData' => $actionsData ]);   
    }

    public function index_etat_risque(Request $request)
    {
        $risque = Risque::join('postes', 'risques.poste_id', '=', 'postes.id')
                ->where('page', '!=', 'am')
                ->where('risques.id', '=', $request->id)
                ->select('risques.*','postes.nom as validateur')
                ->first();

        $causesData = [];
        $actionsDatap = [];
        $actionsDatac = [];

        if($risque)
        {
            $risque_pdf = Pdf_file::where('risque_id', $risque->id)->first();
            if ($risque_pdf) {
                $risque->pdf_nom = $risque_pdf->pdf_nom;
            } else {
                // Gérer le cas où aucun enregistrement n'est trouvé
                $risque->pdf_nom = null; // Ou définissez-le comme vous le souhaitez
            }
            
            $processus = Processuse::where('id', $risque->processus_id)->first();
            $risque->nom_processus = $processus->nom;

            $actionsp = Action::join('postes', 'actions.poste_id', '=', 'postes.id')
                ->where('actions.risque_id', $risque->id)
                ->where('actions.type', 'preventive')
                ->select('actions.*','postes.nom as responsable')
                ->get();
            $risque->nbre_actionp = count($actionsp);

            $actionsDatap[$risque->id] = [];
            
            foreach ($actionsp as $actionp) {
                $suivi = Suivi_action::where('action_id', $actionp->id)->first();

                if ($suivi) {
                    $actionsDatap[$risque->id][] = [
                        'suivi' => 'oui',
                        'action' => $actionp->action,
                        'delai' => $actionp->date,
                        'date_action' => $suivi->date_action,
                        'date_suivi' => $suivi->date_suivi,
                        'type' => $actionp->type,
                        'responsable' => $actionp->responsable,
                    ];
                }else{
                    $actionsDatap[$risque->id][] = [
                        'suivi' => 'non',
                        'action' => $actionp->action,
                        'delai' => $actionp->date,
                        'type' => $actionp->type,
                        'responsable' => $actionp->responsable,
                    ];
                }
            }


            $actionsc = Action::join('postes', 'actions.poste_id', '=', 'postes.id')
                ->where('actions.risque_id', $risque->id)
                ->where('actions.type', 'corrective')
                ->select('actions.*','postes.nom as responsable')
                ->get();
                $risque->nbre_actionc = count($actionsc);

            $actionsDatac[$risque->id] = [];
            
            foreach($actionsc as $actionc)
            {
                $actionsDatac[$risque->id][] = [
                    'action' => $actionc->action,
                    'responsable' => $actionc->responsable,
                ];
            }

            $causes = Cause::where('causes.risque_id', $risque->id)->get();
            $risque->nbre_cause = count($causes);
            
            $causesData[$risque->id] = [];
            
            foreach($causes as $cause)
            {
                $causesData[$risque->id][] = [
                    'cause' => $cause->nom,
                    'dispositif' => $cause->dispositif,
                    'validateur' => $risque->validateur,
                ];
            }
        }

        $color_para = Color_para::where('nbre0', '=', '0')->first();
        $color_intervals = Color_interval::orderBy('nbre1', 'asc')->get();
        $color_interval_nbre = count($color_intervals);

        return view('etat.risque', [
            'risque' => $risque, 
            'causesData' => $causesData, 
            'actionsDatap' => $actionsDatap , 
            'actionsDatac' => $actionsDatac,
            
            'color_para' => $color_para,
            'color_intervals' => $color_intervals,
            'color_interval_nbre' => $color_interval_nbre,
        ]);
    }

    public function index_etat_processus(Request $request)
    {
        $processu = Processuse::find($request->id);

        $objectifData = [];

        if ($processu) {

            $processu->nbre = Objectif::where('processus_id', $processu->id)->count();
            $objectifs = Objectif::where('processus_id', $processu->id)->get();

            $objectifData[$processu->id] = [];
            foreach($objectifs as $objectif)
            {
                $objectifData[$processu->id][] = [
                    'objectif' => $objectif->nom,
                ];
            }
        }

        return view('etat.processus', ['processu' => $processu, 'objectifData' => $objectifData]);
    }

    public function index_etat_cause(Request $request)
    {
        $cause = cause::join('risques', 'causes.risque_id', 'risques.id')
                        ->join('processuses', 'risques.processus_id', 'processuses.id')
                        ->where('causes.id', $request->id)
                        ->select('causes.*','risques.nom as risque', 'processuses.nom as processus')
                        ->first();

        return view('etat.cause', ['cause' => $cause]);
    }

    public function index_etat_actionp(Request $request)
    {
        $action = Action::join('postes', 'actions.poste_id', 'postes.id')
                        ->join('risques', 'actions.risque_id', 'risques.id')
                        ->join('processuses', 'risques.processus_id', 'processuses.id')
                        ->where('actions.id', $request->id)
                        ->select('actions.*', 'processuses.nom as processus', 'risques.nom as risque','postes.nom as poste')
                        ->first();
        if($action){
            $suivi= Suivi_action::where('action_id', $request->id)->first();
            $action->suivi = 'oui';
        }else{
            $action->suivi = 'non';
        }
        

        return view('etat.actionp', ['action' => $action, 'suivi' => $suivi]);
    }

    public function index_etat_actionc(Request $request)
    {
        $action = Action::join('risques', 'actions.risque_id', 'risques.id')
                        ->join('processuses', 'risques.processus_id', 'processuses.id')
                        ->where('actions.id', $request->id)
                        ->select('actions.*', 'processuses.nom as processus', 'risques.nom as risque')
                        ->first();

        return view('etat.actionc', ['action' => $action]);
    }

}
