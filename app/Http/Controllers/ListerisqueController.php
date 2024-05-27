<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Events\NotificationAup;
use App\Events\NotificationRisqueup;

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
use App\Models\Color_para;
use App\Models\Color_interval;
use App\Models\Amelioration;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class ListerisqueController extends Controller
{
    public function index_liste_risque()
    {
        $risques = Risque::join('postes', 'risques.poste_id', '=', 'postes.id')
                ->where('page', '!=', 'am')
                ->select('risques.*','postes.nom as validateur')
                ->get();

        $causesData = [];
        $actionsDatap = [];
        $actionsDatac = [];

        $nbre_total = Amelioration::all()->count();

        foreach($risques as $risque)
        {
            if($nbre_total > 0){

                $risque->nbre = Amelioration::where('risque_id', $risque->id)->where('choix_select', 'risque')->count();
                $risque->progess = ($risque->nbre / $nbre_total) * 100;
                $risque->progess = number_format($risque->progess, 2);
                
            }else{

                $risque->progess = 0;

            }

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
            
            foreach($actionsp as $actionp)
            {
                $actionsDatap[$risque->id][] = [
                    'action' => $actionp->action,
                    'date_suivip' => $actionp->date,
                    'type' => $actionp->type,
                    'responsable' => $actionp->responsable,
                ];
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

        return view('liste.risque', [
            'risques' => $risques, 
            'causesData' => $causesData, 
            'actionsDatap' => $actionsDatap , 
            'actionsDatac' => $actionsDatac,
            'color_para' => $color_para,
            'color_intervals' => $color_intervals,
            'color_interval_nbre' => $color_interval_nbre,
        ]);
    }

    public function index_risque_actionup()
    {
        $risques = Risque::join('rejets', 'rejets.risque_id', '=', 'risques.id')
                ->join('postes', 'risques.poste_id', '=', 'postes.id')
                ->join('processuses', 'risques.processus_id', '=', 'processuses.id')
                ->where('statut' ,'non_valider')
                ->where('page', '!=', 'am')
                ->select('risques.*','processuses.nom as processus', 'rejets.motif as motif')
                ->get();

        foreach ($risques as $risque) {
            $rech = rejet::where('risque_id', '=', $risque->id)->first();
            if ($rech) {
                $risque->motif = $rech->motif;
            }
        }

        $color_para = Color_para::where('nbre0', '=', '0')->first();
        $color_intervals = Color_interval::orderBy('nbre1', 'asc')->get();
        $color_interval_nbre = count($color_intervals);


        return view('traitement.actionup', [
            'risques' => $risques,
            'color_para' => $color_para,
            'color_intervals' => $color_intervals,
            'color_interval_nbre' => $color_interval_nbre,
            
             ]);
    }

    public function index_risque_actionup2(Request $request)
    {
        $risque = Risque::join('rejets', 'rejets.risque_id', '=', 'risques.id')
                ->join('postes', 'risques.poste_id', '=', 'postes.id')
                ->where('risques.id', '=' ,$request->id)
                ->where('page', '!=', 'am')
                ->select('risques.*','postes.nom as validateur', 'rejets.motif as motif','postes.id as poste_id')
                ->first();

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
            $risque->processus_id = $processus->id;

            $actionsp = Action::join('postes', 'actions.poste_id', '=', 'postes.id')
                ->where('actions.risque_id', $risque->id)
                ->where('actions.type', 'preventive')
                ->select('actions.*','postes.nom as responsable', 'postes.id as poste_id')
                ->get();

            $actionsc = Action::join('postes', 'actions.poste_id', '=', 'postes.id')
                ->where('actions.risque_id', $risque->id)
                ->where('actions.type', 'corrective')
                ->select('actions.*','postes.nom as responsable', 'postes.id as poste_id')
                ->get();

            $causes = Cause::where('causes.risque_id', $risque->id)->get();
            
        }
        $postes = Poste::where('occupe', 'oui')->get();
        
        $processuses = Processuse::all();

        $color_para = Color_para::where('nbre0', '=', '0')->first();
        $color_intervals = Color_interval::orderBy('nbre1', 'asc')->get();
        $color_interval_nbre = count($color_intervals);

        $pdfFiles = Pdf_file::all();
        $pdfFiles2 = Pdf_file_processus::all();

        return view('traitement.actionup2', [
            'risque' => $risque, 
            'causes' => $causes, 
            'actionsp' => $actionsp , 'actionsc' => $actionsc, 
            'postes' => $postes, 
            'processuses' => $processuses,
            'color_para' => $color_para,
            'color_intervals' => $color_intervals,
            'color_interval_nbre' => $color_interval_nbre,
            'pdfFiles' => $pdfFiles,
            'pdfFiles2' => $pdfFiles2,
        ]);
    }

    public function index_risque_actionup2_traitement(Request $request)
    {

        $processus_id = $request->input('processus_id');

        $risque_id = $request->input('risque_id');
        $nom_risque = $request->input('risque');
        $vrai = $request->input('vrai');
        $gravite = $request->input('gravite');
        
        if($request->operation ==='addition'){
            $evaluation = $request->input('vrai') + $request->input('gravite');
        }elseif($request->operation ==='multiplication'){
            $evaluation = $request->input('vrai') * $request->input('gravite');
        }
        

        $cout = $request->input('cout');
        $vrai_residuel = $request->input('vrai_residuel');
        $gravite_residuel = $request->input('gravite_residuel');

        if($request->operation ==='addition'){
            $evaluation_residuel = $request->input('vrai_residuel') + $request->input('gravite_residuel');
        }elseif($request->operation ==='multiplication'){
            $evaluation_residuel = $request->input('vrai_residuel') * $request->input('gravite_residuel');
        }

        
        $cout_residuel = $request->input('cout_residuel');
        $traitement = $request->input('traitement');
        $validateur = $request->input('poste_id');

        $risque = Risque::where('id', $risque_id)->first();

        if ($risque) {

            $risque->nom = $nom_risque;
            $risque->vraisemblence = $vrai;
            $risque->gravite = $gravite;
            $risque->evaluation = $evaluation;
            $risque->cout = $cout;
            $risque->vraisemblence_residuel = $vrai_residuel;
            $risque->gravite_residuel = $gravite_residuel;
            $risque->evaluation_residuel = $evaluation_residuel;
            $risque->cout_residuel = $cout_residuel;
            $risque->processus_id = $processus_id;
            $risque->traitement = $traitement;
            $risque->poste_id = $validateur;
            $risque->statut = 'update';
            $risque->update();

            if ($request->hasFile('pdfFile') && $request->file('pdfFile')->isValid()) {

                $originalFileName = $request->file('pdfFile')->getClientOriginalName();
                $pdfPathname = $request->file('pdfFile')->storeAs('public/pdf', $originalFileName);

                // Enregistrez le fichier PDF dans la base de données
                $pdfFile = Pdf_file::where('risque_id', $risque_id)->first();

                if ($pdfFile) {

                    $pdfFile->pdf_nom = $originalFileName;
                    $pdfFile->pdf_chemin = $pdfPathname;
                    $pdfFile->update();
                } else {

                    $pdfFile = new Pdf_file();
                    $pdfFile->pdf_nom = $originalFileName;
                    $pdfFile->pdf_chemin = $pdfPathname;
                    $pdfFile->risque_id = $risque_id;
                    $pdfFile->save();
                }

            }

            //------------------------------------------------------------------------------------------------

            $cause_id = $request->input('cause_id');
            $nom_cause = $request->input('nom_cause');
            $dispositif = $request->input('dispositif');

            foreach ($cause_id as $index => $valeur) {

                if ($cause_id[$index] !== '0') {

                    $cause = Cause::where('id', $cause_id[$index])->first();

                    if ($cause) {

                        $cause->nom = $nom_cause[$index];
                        $cause->dispositif = $dispositif[$index];
                        $cause->update();
                    }


                } else {

                    $cause = new Cause();
                    $cause->nom = $nom_cause[$index];
                    $cause->dispositif = $dispositif[$index];
                    $cause->risque_id = $risque_id;
                    $cause->page = 'risk';
                    $cause->save();
                }

            }

            $id_suppr_c = $request->input('id_suppr_c');
            $suppr_c = $request->input('suppr_c');

                foreach ($id_suppr_c as $index => $valeur) {
                    if (isset($suppr_c[$index]) && $suppr_c[$index] === 'oui') {
                        $cause = Cause::where('id', $valeur)->delete();
                    }
                }

            //--------------------------------------------------------------------------------------------------

            $action_idc = $request->input('action_idc');
            $actionc = $request->input('actionc');
            $responsable_idc = $request->input('poste_idc');

            foreach ($action_idc as $index => $valeur) {

                if ($action_idc[$index] !== '0') {
                    
                    $nouvelleActionC = Action::where('id', $action_idc[$index])->first();

                    if ($nouvelleActionC) {

                        $nouvelleActionC->action = $actionc[$index];
                        $nouvelleActionC->poste_id = $responsable_idc[$index];
                        $nouvelleActionC->update();
                    }

                } else {

                    $nouvelleActionC = new Action();
                    $nouvelleActionC->action = $actionc[$index];
                    $nouvelleActionC->poste_id = $responsable_idc[$index];
                    $nouvelleActionC->risque_id = $risque_id;
                    $nouvelleActionC->type = 'corrective';
                    $nouvelleActionC->page = 'risk';
                    $nouvelleActionC->save();
                }
            }

            $id_suppr_ac = $request->input('id_suppr_ac');
            $suppr_ac = $request->input('suppr_ac');

                foreach ($id_suppr_ac as $index => $valeur) {
                    if (isset($suppr_ac[$index]) && $suppr_ac[$index] === 'oui') {
                        $actionc2 = Action::where('id', $id_suppr_ac[$index])->delete();
                    }
                }

            //------------------------------------------------------------------------------------


            $action_idp = $request->input('action_idp');
            $actionp = $request->input('actionp');
            $delai = $request->input('delai');
            $responsable_idp = $request->input('poste_idp');
            $action_idp_suppr = $request->input('action_idp_suppr');
            $suppr_actionp = $request->input('suppr_actionp');

            foreach ($action_idp as $index => $valeur) {

                if ($action_idp[$index] !== '0') {
                    
                    $nouvelleActionP = Action::where('id', $action_idp[$index])->first();

                    if ($nouvelleActionP) {

                        $nouvelleActionP->action = $actionp[$index];
                        $nouvelleActionP->poste_id = $responsable_idp[$index];
                        $nouvelleActionP->date = $delai[$index];
                        $nouvelleActionP->update();
                    }

                } else {

                    $nouvelleActionP = new Action();
                    $nouvelleActionP->action = $actionp[$index];
                    $nouvelleActionP->poste_id = $responsable_idp[$index];
                    $nouvelleActionP->risque_id = $risque_id;
                    $nouvelleActionP->date = $delai[$index];
                    $nouvelleActionP->type = 'preventive';
                    $nouvelleActionP->page = 'risk';
                    $nouvelleActionP->save();

                }
            }

            $id_suppr_ap = $request->input('id_suppr_ap');
            $suppr_ap = $request->input('suppr_ap');

                foreach ($id_suppr_ap as $index => $valeur) {
                    if (isset($suppr_ap[$index]) && $suppr_ap[$index] === 'oui') {
                        $actionc = Action::where('id', $id_suppr_ap[$index])->delete();
                    }
                }

            //----------------------------------------------------------------------------------------------------

            $his = new Historique_action();
            $his->nom_formulaire = 'Risque non valider';
            $his->nom_action = 'Modifier';
            $his->user_id = Auth::user()->id;
            $his->save();

            try {

                event(new NotificationRisqueup());

                $user = User::join('postes', 'users.poste_id', 'postes.id')
                                ->where('postes.id', $validateur)
                                ->select('users.*')
                                ->first();
                if ($user) {

                    $mail = new PHPMailer(true);
                    $mail->isHTML(true);
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'coherencemail01@gmail.com';
                    $mail->Password = 'kiur ejgn ijqt kxam';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    // Destinataire, sujet et contenu de l'email
                    $mail->setFrom('coherencemail01@gmail.com', 'Coherence');
                    $mail->addAddress($user->email);
                    $mail->Subject = 'ALERT !';
                    $mail->Body = 'Mise à jour d´une fiche Risque';
                    // Envoi de l'email
                    $mail->send();
                }
            } catch (BroadcastException $exception) {
                
            }

            return redirect()->route('index_risque_actionup')->with('success', 'Modification éffectuée.');

        }
    }

    public function risque_delete($id)
    {
        $delete1 = rejet::where('risque_id', '=', $id)->delete();

        $delete2 = Action::where('risque_id', '=', $id)->delete();

        $delete3 = Cause::where('risque_id', '=', $id)->delete();

        $delete4 = Pdf_file::where('risque_id', $id)->first();

        if ($delete4) {
            $pdfPathname = $delete4->pdf_chemin;

            if (file_exists($pdfPathname)) {
                unlink($pdfPathname);
            }
            // Supprimer d'abord l'enregistrement de pdf_files
            $del = Pdf_file::where('risque_id', $id)->delete();
        }

        $delete5 = Risque::where('id', '=', $id)->delete();

        if($delete1 && $delete2 && $delete3 && $delete5)
        {
            return redirect()->back()->with('success', 'Suppression éffectuée.');
        }

        return redirect()->back()->with('error', 'Echec de la Suppression.');
    }
}
