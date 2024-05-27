<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\Processuse;
use App\Models\Objectif;
use App\Models\Risque;
use App\Models\Cause;
use App\Models\Rejet;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\Pdf_file;
use App\Models\User;
use App\Models\Historique_action;
use App\Models\Poste;
use App\Models\Amelioration;
use App\Models\Suivi_amelioration;
use App\Models\Color_para;
use App\Models\Color_interval;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class StatistiqueController extends Controller
{

    public function index_stat()
    {
        $processus = Processuse::all();
        $risques = Risque::where('page', 'risk')->get();
        $nbre_processus = $processus->count();
        $nbre_risque = Risque::where('page', 'risk')->count();
        $nbre_cause = Cause::where('page', 'risk')->count();

        $nbre_am = Amelioration::all()->count();
        $nbre_am_nci = Amelioration::where('type', '=', 'non_conformite_interne')->count();
        $nbre_am_r = Amelioration::where('type', '=', 'reclamation')->count();
        $nbre_am_c = Amelioration::where('type', '=', 'contentieux')->count();

        $nbre_ris_soumis = Risque::where('statut', 'soumis')->count();
        $nbre_ris_n_valider = Risque::where('statut', 'non_valider')
                                    ->Orwhere('statut', 'update')
                                    ->count();
        $nbre_ris_valider =Risque::where('statut', 'valider')->count();

        $types = ['non_conformite_interne', 'reclamation', 'contentieux'];

        $statistics = [];

        $nbre = 0;

        foreach ($types as $type) {
            $statistics[$type] = [];

            $statistics[$type]['total'] = Amelioration::where('ameliorations.type', $type)->count();

            $statistics[$type]['causes'] = Amelioration::where('ameliorations.type', $type)->where('choix_select', 'cause')->count();

            $statistics[$type]['risques'] = Amelioration::where('ameliorations.type', $type)->where('choix_select', 'risque')->count();
                
            $statistics[$type]['causes_risques_nt'] = Amelioration::where('ameliorations.type', $type)->where('choix_select', 'cause_risque_nt')->count();

            if($nbre_am > 0){

                $nbre = Amelioration::where('type', $type)->count();
                $statistics[$type]['progres'] = ($nbre / $nbre_am) * 100;
                $statistics[$type]['progres'] = number_format($statistics[$type]['progres'], 2);
                
            }else{

                $statistics[$type]['progres'] = 0;

            }
        }
        
        $nbre_ap = Action::where('type', 'preventive')->count();

        $nbre_ed_ap = Suivi_action::join('actions', 'actions.id', '=', 'suivi_actions.action_id')
                                    ->join('risques', 'risques.id', '=', 'actions.risque_id')
                                    ->where('suivi_actions.statut', 'realiser')
                                    ->where('actions.date', '>=', 'suivi_actions.date_action')
                                    ->count();

        $nbre_ehd_ap = Suivi_action::join('actions', 'actions.id', '=', 'suivi_actions.action_id')
                                    ->join('risques', 'risques.id', '=', 'actions.risque_id')
                                    ->where('suivi_actions.statut', 'realiser')
                                    ->where('actions.date', '<', 'suivi_actions.date_action')
                                    ->count();

        $nbre_hd_ap = Suivi_action::where('statut', '=', 'non-realiser')->count();



        $nbre_ac = Action::where('type', 'corrective')->where('page', 'risk')->count();
        $nbre_poste = Poste::all()->count();

        $users = User::join('postes', 'users.poste_id', '=', 'postes.id')
                    ->select('users.*', 'postes.nom as poste')
                    ->inRandomOrder()
                    ->limit(4)
                    ->get();

        $nbre_user = User::all()->count();

        $color_para = Color_para::where('nbre0', '=', '0')->first();
        $color_intervals = Color_interval::orderBy('nbre1', 'asc')->get();
        $color_interval_nbre = count($color_intervals);

        $his = Historique_action::orderBy('created_at', 'desc')
                                ->limit(10)
                                ->get();

        $staut_am_soumis = Amelioration::where('statut', 'soumis')->count();
        $staut_am_rejeter = Amelioration::where('statut', 'non-valider')
                                        ->where('statut', 'modif')
                                        ->where('statut', 'update')
                                        ->count();
        $staut_am_valider = Amelioration::where('statut', 'valider')->count();
        $staut_am_eff = Amelioration::where('statut', 'date_efficacite')->count();
        $staut_am_clotu = Amelioration::where('statut', 'cloturer')->count();


        $types_processus = Processuse::all();
        $objectifData = [];
        $risqsData = [];

        foreach ($types_processus as $types_pro) {

            $types_pro->nbre_nci = Amelioration::join('risques', 'ameliorations.risque_id', 'risques.id')
                                                ->where('ameliorations.type', 'non_conformite_interne')
                                                ->where('risques.processus_id', $types_pro->id)
                                                ->count();
            $types_pro->nbre_r = Amelioration::join('risques', 'ameliorations.risque_id', 'risques.id')
                                                ->where('ameliorations.type', 'reclamation')
                                                ->where('risques.processus_id', $types_pro->id)
                                                ->count();
            $types_pro->nbre_c = Amelioration::join('risques', 'ameliorations.risque_id', 'risques.id')
                                                ->where('ameliorations.type', 'contentieux')
                                                ->where('risques.processus_id', $types_pro->id)
                                                ->count();
            $objectifs = Objectif::where('processus_id', $types_pro->id)->get();

            $objectifData[$types_pro->id] = [];
            foreach($objectifs as $objectif)
            {
                $objectifData[$types_pro->id][] = [
                    'objectif' => $objectif->nom,
                    'id' => $objectif->id,
                ];
            }

            $risqs = Risque::where('processus_id', $types_pro->id)
                            ->where('date_validation', '!=', null)
                            ->get();

            if ($risqs) {
                $types_pro->nbre_risque = $risqs->count();

                $totalEvaluation = 0;
                $risqsData[$types_pro->id] = [];

                foreach ($risqs as $ris)
                {
                    $totalEvaluation += $ris->evaluation_residuel;

                    $risqsData[$types_pro->id][] = [
                        'nom' => $ris->nom,
                        'evaluation_residuel' => $ris->evaluation_residuel,
                    ];
                }

                if ($risqs->count() > 0) {
                    $evagg = $totalEvaluation / $risqs->count();
                    $evag = number_format($evagg, 1);
                } else {
                    $evag = 0;
                }

                $types_pro->evag = $evag;
            } else {
                $types_pro->nbre_risque = 0;
                $types_pro->evag = 0;
            }
        }

        $types_processus = $types_processus->sortByDesc('evag');

        $types_risque = Risque::join('postes', 'risques.poste_id', '=', 'postes.id')
                            ->where('page', '!=', 'am')
                            ->select('risques.*','postes.nom as validateur')
                            ->get();
        $causesData = [];
        $actionsDatap = [];
        $actionsDatac = [];

        foreach ($types_risque as $types_ris) {
            $types_ris->nbre_nci = Amelioration::join('risques', 'ameliorations.risque_id', 'risques.id')
                                                ->where('ameliorations.type', 'non_conformite_interne')
                                                ->where('risques.id', $types_ris->id)
                                                ->count();
            $types_ris->nbre_r = Amelioration::join('risques', 'ameliorations.risque_id', 'risques.id')
                                                ->where('ameliorations.type', 'reclamation')
                                                ->where('risques.id', $types_ris->id)
                                                ->count();
            $types_ris->nbre_c = Amelioration::join('risques', 'ameliorations.risque_id', 'risques.id')
                                                ->where('ameliorations.type', 'contentieux')
                                                ->where('risques.id', $types_ris->id)
                                                ->count();

            $process = Processuse::where('id', $types_ris->processus_id)->first();
            $types_ris->nom_processus = $process->nom;

            $actionsp = Action::join('postes', 'actions.poste_id', '=', 'postes.id')
                ->where('actions.risque_id', $types_ris->id)
                ->where('actions.type', 'preventive')
                ->select('actions.*','postes.nom as responsable')
                ->get();
            $types_ris->nbre_actionp = count($actionsp);

            $actionsDatap[$types_ris->id] = [];
            
            foreach ($actionsp as $actionp) {
                $suivi = Suivi_action::where('action_id', $actionp->id)->first();

                if ($suivi) {
                    $actionsDatap[$types_ris->id][] = [
                        'suivi' => 'oui',
                        'action' => $actionp->action,
                        'delai' => $actionp->date,
                        'date_action' => $suivi->date_action,
                        'date_suivi' => $suivi->date_suivi,
                        'type' => $actionp->type,
                        'responsable' => $actionp->responsable,
                    ];
                }else{
                    $actionsDatap[$types_ris->id][] = [
                        'suivi' => 'non',
                        'action' => $actionp->action,
                        'delai' => $actionp->date,
                        'type' => $actionp->type,
                        'responsable' => $actionp->responsable,
                    ];
                }
            }


            $actionsc = Action::join('postes', 'actions.poste_id', '=', 'postes.id')
                ->where('actions.risque_id', $types_ris->id)
                ->where('actions.type', 'corrective')
                ->select('actions.*','postes.nom as responsable')
                ->get();
                $types_ris->nbre_actionc = count($actionsc);

            $actionsDatac[$types_ris->id] = [];
            
            foreach($actionsc as $actionc)
            {
                $actionsDatac[$types_ris->id][] = [
                    'action' => $actionc->action,
                    'responsable' => $actionc->responsable,
                ];
            }

            $causes = Cause::where('causes.risque_id', $types_ris->id)->get();
            $types_ris->nbre_cause = count($causes);
            
            $causesData[$types_ris->id] = [];
            
            foreach($causes as $cause)
            {
                $causesData[$types_ris->id][] = [
                    'cause' => $cause->nom,
                    'dispositif' => $cause->dispositif,
                    'validateur' => $types_ris->validateur,
                ];
            }
        }

        $types_risque = $types_risque->sortByDesc('evaluation_residuel');

        $types_cause = cause::join('risques', 'causes.risque_id', 'risques.id')
                        ->join('processuses', 'risques.processus_id', 'processuses.id')
                        ->select('causes.*','risques.nom as risque', 'processuses.nom as processus')
                        ->get();

        foreach ($types_cause as $types_cau) {
            $types_cau->nbre_nci = Amelioration::join('causes', 'ameliorations.cause_id', 'causes.id')
                                                ->where('ameliorations.type', 'non_conformite_interne')
                                                ->where('causes.id', $types_cau->id)
                                                ->count();
            $types_cau->nbre_r = Amelioration::join('causes', 'ameliorations.cause_id', 'causes.id')
                                                ->where('ameliorations.type', 'reclamation')
                                                ->where('causes.id', $types_cau->id)
                                                ->count();
            $types_cau->nbre_c = Amelioration::join('causes', 'ameliorations.cause_id', 'causes.id')
                                                ->where('ameliorations.type', 'contentieux')
                                                ->where('causes.id', $types_cau->id)
                                                ->count();
        }

        $nbre_action = Action::join('suivi_actions', 'suivi_actions.action_id', 'actions.id')
                            ->where('actions.type', 'preventive')
                            ->count();
        $nbre_action_neff = Action::join('suivi_actions', 'suivi_actions.action_id', 'actions.id')
                            ->where('actions.type', 'preventive')
                            ->where('suivi_actions.statut', 'non-realiser')
                            ->count();
        $nbre_action_eff = Action::join('suivi_actions', 'suivi_actions.action_id', 'actions.id')
                            ->where('actions.type', 'preventive')
                            ->where('suivi_actions.statut', 'realiser')
                            ->count();

        return view('statistique.index', ['statistics' => $statistics, 'processus' => $processus, 'nbre_processus' => $nbre_processus, 'nbre_risque' => $nbre_risque, 'nbre_cause' => $nbre_cause, 'nbre_ap' => $nbre_ap, 'nbre_am' => $nbre_am, 'nbre_ed_ap' => $nbre_ed_ap,'nbre_ehd_ap' => $nbre_ehd_ap,'nbre_hd_ap' => $nbre_hd_ap , 'nbre_ac' => $nbre_ac,'nbre_poste' => $nbre_poste, 'risques' => $risques,'color_para' => $color_para, 'color_intervals' => $color_intervals, 'color_interval_nbre' => $color_interval_nbre, 'users' => $users, 'nbre_am_nci' => $nbre_am_nci, 'nbre_am_r' => $nbre_am_r, 'nbre_am_c' => $nbre_am_c, 'nbre_user' => $nbre_user,'his' => $his,'nbre_ris_soumis' => $nbre_ris_soumis,'nbre_ris_n_valider' => $nbre_ris_n_valider,'nbre_ris_valider' => $nbre_ris_valider,'staut_am_soumis' => $staut_am_soumis, 'staut_am_rejeter' => $staut_am_rejeter, 'staut_am_valider' => $staut_am_valider, 'staut_am_eff' => $staut_am_eff, 'staut_am_clotu' => $staut_am_clotu,'types_processus' => $types_processus, 'risqsData' => $risqsData, 'objectifData' => $objectifData ,'types_risque' => $types_risque, 'causesData' => $causesData, 'actionsDatap' => $actionsDatap, 'actionsDatac' => $actionsDatac, 'types_cause' => $types_cause, 'nbre_action' => $nbre_action, 'nbre_action_neff' => $nbre_action_neff, 'nbre_action_eff' => $nbre_action_eff,]);
    }

    public function get_processus($id)
    {
        $types = ['non_conformite_interne', 'reclamation', 'contentieux'];
        $nbres = [];

        foreach ($types as $type) {
            $nbres[$type] = amelioration::join('risques', 'ameliorations.risque_id', 'risques.id')
                                            ->join('processuses', 'risques.processus_id', 'processuses.id')
                                            ->where('risques.page', 'risk')
                                            ->where('ameliorations.type', $type)
                                            ->where('processuses.id', $id)
                                            ->count();
        }

        return response()->json([
            'data' => array_values($nbres),
        ]);
    }

    public function get_risque($id)
    {
        $types = ['non_conformite_interne', 'reclamation', 'contentieux'];
        $nbres = [];

        foreach ($types as $type) {
            $nbres[$type] = amelioration::where('type', $type)
                                            ->where('risque_id', $id)
                                            ->count();
        }

        return response()->json([
            'data' => array_values($nbres),
        ]);
    }

    public function get_date(Request $request)
    {
        $date1 = Carbon::parse($request->input('date1'))->format('Y-m-d');
        $date2 = Carbon::parse($request->input('date2'))->format('Y-m-d');

        $types = ['non_conformite_interne', 'reclamation', 'contentieux'];
        $nbres = [];

        foreach ($types as $type) {
            $nbres[$type] = Amelioration::where('ameliorations.date_fiche', '>=', $date1)
                                        ->where('ameliorations.date_fiche', '<=', $date2)
                                        ->where('ameliorations.type', $type)
                                        ->count();
        }

        return response()->json([
            'data' => array_values($nbres),
        ]);
    }
}
