<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Events\NotificationAcorrective;
use App\Events\NotificationApreventive;
use App\Events\NotificationAnon;
use App\Events\NotificationProcessus;
use App\Events\NotificationRisque;
use App\Events\NotificationAup;

use App\Models\Processuse;
use App\Models\Autorisation;
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

class ListeuserController extends Controller
{
    public function index()
    {

        $users = User::join('postes', 'users.poste_id', 'postes.id')
                    ->join('autorisations', 'autorisations.user_id', 'users.id')
                    ->select('users.*','autorisations.new_user as new_user', 'autorisations.list_user as list_user' ,'autorisations.new_poste as new_poste', 'autorisations.list_poste as list_poste' ,'postes.nom as poste','autorisations.historiq as historiq','autorisations.stat as stat','autorisations.new_proces as new_proces','autorisations.list_proces as list_proces', 'autorisations.eva_proces as eva_proces' ,'autorisations.new_risk as new_risk','autorisations.list_risk as list_risk', 'autorisations.val_risk as val_risk', 'autorisations.act_n_val as act_n_val', 'autorisations.color_para as color_para' ,'autorisations.suivi_actp as suivi_actp','autorisations.list_actp as list_actp', 'autorisations.suivi_actc as suivi_actc' ,'autorisations.list_actc_eff as list_actc_eff','autorisations.list_actc as list_actc','autorisations.fiche_am as fiche_am','autorisations.list_am as list_am','autorisations.val_am as val_am','autorisations.am_n_val as am_n_val', 'autorisations.list_cause as list_cause')
                    ->get();

        return view('liste.user',['users' => $users]);
    }

    public function index_user_modif(Request $request)
    {
        $user = User::join('autorisations', 'autorisations.user_id', 'users.id')
                    ->where('users.id', $request->id)
                    ->select('users.*','autorisations.new_user as new_user', 'autorisations.list_user as list_user' ,'autorisations.new_poste as new_poste', 'autorisations.list_poste as list_poste','autorisations.historiq as historiq','autorisations.stat as stat','autorisations.new_proces as new_proces','autorisations.list_proces as list_proces', 'autorisations.eva_proces as eva_proces' ,'autorisations.new_risk as new_risk','autorisations.list_risk as list_risk', 'autorisations.val_risk as val_risk', 'autorisations.act_n_val as act_n_val', 'autorisations.color_para as color_para' ,'autorisations.suivi_actp as suivi_actp','autorisations.list_actp as list_actp', 'autorisations.suivi_actc as suivi_actc' ,'autorisations.list_actc_eff as list_actc_eff','autorisations.list_actc as list_actc','autorisations.fiche_am as fiche_am','autorisations.list_am as list_am','autorisations.val_am as val_am','autorisations.am_n_val as am_n_val', 'autorisations.list_cause as list_cause')
                    ->first();

        return view('liste.user_modif',['user' => $user]);
    }

    public function index_modif_traitement(Request $request)
    {
        $auto = Autorisation::where('user_id', $request->user_id)->first();
        $auto->new_user = $request->new_user;
        $auto->list_user = $request->list_user;
        $auto->new_poste = $request->new_poste;
        $auto->list_poste = $request->list_poste;
        $auto->historiq = $request->historiq;
        $auto->stat = $request->stat;

        $auto->new_proces = $request->new_proces;
        $auto->list_proces = $request->list_proces;
        $auto->eva_proces = $request->eva_proces;

        $auto->new_risk = $request->new_risk;
        $auto->list_risk = $request->list_risk;
        $auto->val_risk = $request->val_risk;
        $auto->act_n_val = $request->act_n_val;
        $auto->color_para = $request->color_para;

        $auto->list_cause = $request->list_cause;

        $auto->suivi_actp = $request->suivi_actp;
        $auto->list_actp = $request->list_actp;

        $auto->suivi_actc = $request->suivi_actc;
        /*--$auto->list_actc_eff = $request->list_actc_eff;--*/
        $auto->list_actc = $request->list_actc;

        $auto->fiche_am = $request->fiche_am;
        $auto->list_am = $request->list_am;
        $auto->val_am = $request->val_am;
        $auto->am_n_val = $request->am_n_val;

        $auto->user_id = $request->user_id;
        $auto->update();

        if ($auto) {

            $his = new Historique_action();
            $his->nom_formulaire = 'Liste des Utilisateurs';
            $his->nom_action = 'Mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()->route('index_liste_user')->with('success', 'Mise à jour effectuée.');
        } else {
            return redirect()->route('index_liste_user')->with('error', 'Mise à jour non éffectuée.');
        }
    }
}
