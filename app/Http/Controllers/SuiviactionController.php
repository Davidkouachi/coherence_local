<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Processuse;
use App\Models\Objectif;
use App\Models\Resva;
use App\Models\Poste;
use App\Models\Risque;
use App\Models\Cause;
use App\Models\Rejet;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\Suivi_amelioration;
use App\Models\User;
use App\Models\Historique_action;
use App\Models\Amelioration;

use App\Events\NotificationApreventive;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class SuiviactionController extends Controller
{
    public function index_suiviaction()
    {
        $actions = Action::join('postes', 'actions.poste_id', '=', 'postes.id')
                ->join('risques', 'actions.risque_id', '=', 'risques.id')
                ->join('processuses', 'risques.processus_id', '=', 'processuses.id')
                ->join('suivi_actions', 'actions.id', '=', 'suivi_actions.action_id')
                ->where('risques.statut', 'valider')
                ->where('suivi_actions.statut', 'non-realiser')
                ->where('actions.type', 'preventive')
                ->select('actions.*','postes.nom as responsable','risques.nom as risque' ,'risques.date_validation as date_validation' ,'processuses.nom as processus','risques.date_validation as date_validation')
                ->get();

        return view('traitement.suiviaction',  ['actions' => $actions]);
    }

    public function index_suiviactionc()
    {

        $ams = Action::join('postes', 'actions.poste_id', '=', 'postes.id')
                    ->join('risques', 'actions.risque_id', '=', 'risques.id')
                    ->join('processuses', 'risques.processus_id', '=', 'processuses.id')
                    ->where('actions.type', 'corrective')
                    ->select('actions.*', 'postes.nom as poste', 'risques.nom as risque', 'processuses.nom as processus')
                    ->get();

        $amData = [];

        foreach ($ams as $am) {
            $rech = Suivi_amelioration::join('actions', 'suivi_ameliorations.action_id', '=', 'actions.id')
                                ->join('ameliorations', 'suivi_ameliorations.amelioration_id', '=', 'ameliorations.id')
                                ->where('suivi_ameliorations.statut', 'non-realiser')
                                ->where('ameliorations.statut', 'valider')
                                ->where('suivi_ameliorations.action_id', $am->id)
                                ->select('suivi_ameliorations.*', 'ameliorations.type as type', 'ameliorations.detecteur as detecteur', 'ameliorations.date_fiche as date_fiche', 'ameliorations.lieu as lieu', 'ameliorations.non_conformite as non_conformite', 'ameliorations.consequence as consequence', 'ameliorations.cause as cause', 'ameliorations.date_fiche as date_fiche', 'ameliorations.date_limite as date_limite', 'ameliorations.nbre_jour as nbre_jour', 'ameliorations.choix_select as choix_select')
                                ->get();

            $am->nbre_am = count($rech);

            $amData[$am->id] = [];

            $maxDateLimite = null;

            foreach($rech as $rec)
            {
                $amData[$am->id][] = [
                    'type' => $rec->type,
                    'lieu' => $rec->lieu,
                    'date_fiche' => $rec->date_fiche,
                    'date_limite' => $rec->date_limite,
                    'nbre_jour' => $rec->nbre_jour,
                    'detecteur' => $rec->detecteur,
                    'non_conformite' => $rec->non_conformite,
                    'consequence' => $rec->consequence,
                    'cause' => $rec->cause,
                    'choix_select' => $rec->choix_select,
                ];

                // Parcourir les données de chaque AM
                foreach ($amData[$am->id] as $detail) {
                    // Convertir la date limite en objet DateTime pour la comparaison
                    $dateLimite = Carbon::createFromFormat('Y-m-d', $detail['date_limite']);
                    
                    // Comparer la date limite actuelle avec la date limite maximale
                    if ($maxDateLimite === null || $dateLimite < $maxDateLimite) {
                        $maxDateLimite = $dateLimite;
                    }
                }               
            }

            $am->delai = $maxDateLimite !== null ? $maxDateLimite->format('d-m-Y') : null;

        }


        return view('traitement.suiviactionc',  ['ams' => $ams, 'amData' => $amData]);
    }

    public function add_suivi_action(Request $request, $id)
    {
        $suivi = Suivi_action::where('action_id', $id)->first();
        if ($suivi)
        {
            $suivi->efficacite = $request->input('efficacite');
            $suivi->commentaire = $request->input('commentaire');
            $suivi->date_action = $request->input('date_action');
            $suivi->statut = 'realiser';
            $suivi->date_suivi = now()->format('Y-m-d\TH:i');
            $suivi->update();

            if ($suivi)
            {

                $his = new Historique_action();
                $his->nom_formulaire = 'Suivi des actions preventive';
                $his->nom_action = 'Suivi effectué';
                $his->user_id = Auth::user()->id;
                $his->save();

                return back()
                        ->with('success', 'Suivi éffectué.');
            }

        }

        return back()
            ->with('error', 'Suivi non éffectuée.');
    }

    public function add_suivi_actionc(Request $request, $id)
    {
            // Récupérer tous les suivis pour cette action
            $suivis = Suivi_amelioration::join('ameliorations', 'suivi_ameliorations.amelioration_id', 
                                                'ameliorations.id')
                                        ->where('ameliorations.statut', 'valider')
                                        ->where('suivi_ameliorations.action_id', $id)
                                        ->select('suivi_ameliorations.*')
                                        ->get();

            if($suivis) 
            {
                foreach ($suivis as $suivi) {
                    
                    $suivi1 = Suivi_amelioration::find($suivi->id);
                    $suivi1->efficacite = $request->input('efficacite');
                    $suivi1->commentaire = $request->input('commentaire');
                    $suivi1->date_action = $request->input('date_action');
                    $suivi1->date_suivi = now()->format('Y-m-d\TH:i');
                    $suivi1->statut = 'realiser';
                    $suivi1->update();

                    // Compter les suivis non réalisés pour cette amélioration
                    $suivi2 = Suivi_amelioration::where('amelioration_id', $suivi->amelioration_id)
                        ->where('statut', 'non-realiser')
                        ->count();

                    // S'il n'y a aucun suivi non réalisé, mettre à jour l'amélioration correspondante
                    if ($suivi2 === 0) {
                        $am = Amelioration::where('id', $suivi->amelioration_id)->first();
                        $am->date_cloture1 = $request->input('date_action');
                        $am->statut = 'date_efficacite';
                        $am->update();
                    }

                    // Enregistrer l'historique de l'action
                    $historique = new Historique_action();
                    $historique->nom_formulaire = 'Suivi des actions corrective';
                    $historique->nom_action = 'Suivi effectué';
                    $historique->user_id = Auth::user()->id;
                    $historique->save();

                }

                return back()->with('success', 'Suivi éffectué.');
            }

        return back()->with('error', 'Echec du suivi .');
    }  

}
