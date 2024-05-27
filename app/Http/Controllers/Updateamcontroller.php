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
use App\Events\NotificationAmvalider;
use App\Events\NotificationAmcorrective;
use App\Events\NotificationAmrejet;

use App\Models\Processuse;
use App\Models\Amelioration;
use App\Models\Objectif;
use App\Models\Risque;
use App\Models\Cause;
use App\Models\Rejet;
use App\Models\Rejet_am;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\Pdf_file;
use App\Models\Pdf_file_processus;
use App\Models\User;
use App\Models\Historique_action;
use App\Models\Poste;
use App\Models\Suivi_amelioration;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Twilio\Rest\Client;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Updateamcontroller extends Controller
{

    public function amup2_traitement(Request $request)
    {
        $amelioration_id = $request->input('amelioration_id');
        $type = $request->input('type');

        $date_fichee = $request->input('date_fiche');
        $dateCarbon = Carbon::createFromFormat('Y-m-d', $date_fichee);
        $date_fiche = $dateCarbon->format('Y-m-d');

        $lieu = $request->input('lieu');
        $detecteur = $request->input('detecteur');
        $non_conformite = $request->input('non_conformite');
        $consequence = $request->input('consequence');
        $cause = $request->input('cause');

        $am = Amelioration::find($amelioration_id);
        $am->type = $type;
        $am->date_fiche = $date_fiche;
        $am->lieu =$lieu;
        $am->detecteur = $detecteur;
        $am->non_conformite = $non_conformite;
        $am->consequence = $consequence;
        $am->cause = $cause;
        $am->statut = 'modif';
        $am->update();

        if ($am) {

            $suivi_id = $request->input('suivi_id');
            $commentaire_am = $request->input('commentaire_am');

            foreach ($suivi_id as $index => $value) {

                $rech = suivi_amelioration::find($suivi_id[$index]);
                if ($rech) {
                    $rech->commentaire_am = $commentaire_am[$index];
                    $rech->update();
                }                           
            }

            $id_suppr = $request->input('id_suppr');
            $suppr = $request->input('suppr');

            if ($id_suppr) {
                foreach ($id_suppr as $index => $valeur) {
                    if (isset($suppr[$index]) && $suppr[$index] === 'oui') {
                        $delete_action = Suivi_amelioration::where('id', $valeur)->delete();
                    }
                }
            }

            $nature1 = $request->input('nature1');
            $processus_id1 = $request->input('processus_id1');
            $risque1 = $request->input('risque1');
            $resume1 = $request->input('resume1');
            $action1 = $request->input('action1');
            $poste_id1 = $request->input('poste_id1');
            $commentaire1 = $request->input('commentaire1');

            if(isset($nature1)) {

                foreach ($nature1 as $index => $valeur) {

                    $risquee = new Risque();
                    $risquee->nom = $risque1[$index];
                    $risquee->page = 'am';
                    $risquee->processus_id = $processus_id1[$index];
                    $risquee->poste_id = $poste_id1[$index];
                    $risquee->save();

                    $cause = new Cause();
                    $cause->nom = $resume1[$index];
                    $cause->page = 'am';
                    $cause->risque_id = $risquee->id;
                    $cause->save();

                    $actionn = new Action();
                    $actionn->action = $action1[$index];
                    $actionn->page = 'am';
                    $actionn->type = 'corrective';
                    $actionn->poste_id = $poste_id1[$index];
                    $actionn->risque_id = $risquee->id;
                    $actionn->save();

                    $suivic = new Suivi_amelioration();
                    $suivic->type = 'action_am';
                    $suivic->nature = $nature1[$index];
                    $suivic->statut = 'non-realiser';
                    $suivic->amelioration_id = $am->id;
                    $suivic->action_id = $actionn->id;
                    $suivic->commentaire_am = $commentaire1[$index];
                    $suivic->save();

                }

            }
            
            $his = new Historique_action();
            $his->nom_formulaire = 'Fiche d\'incident non validé';
            $his->nom_action = 'mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()->route('index_amup')->with('success', 'Mise à jour éffectuée.');
        }

        return redirect()->route('index_amup')->with('error', 'Echec de la mise à jour');
    }

    public function amup2_add_traitement(Request $request)
    {
        $trouve = $request->input('trouve');
        $trouve_id = $request->input('trouve_id');

        $nature = $request->input('nature');
        $processus_id = $request->input('processus_id');
        $risque = $request->input('risque');
        $resume = $request->input('resume');
        $choix_select = $request->input('choix_select');
        $action = $request->input('action');
        $naction = $request->input('naction');
        $action_id = $request->input('action_id');
        $poste_id = $request->input('poste_id');
        $date_action = $request->input('date_action');
        $commentaire = $request->input('commentaire');
        $causeSelect_id = $request->input('causeSelect_id');
        $risqueSelect_id = $request->input('risqueSelect_id');

        $am = Amelioration::where('id', '=', $request->amelioration_id)->first();
        $am->statut = 'modif';
        $am->choix_select = $choix_select;
        if ($choix_select === 'cause') {
            $am->cause_id = $causeSelect_id;

            $rech_cause = Cause::find($causeSelect_id);
            $am->risque_id = $rech_cause->risque_id;
        }
        if ($choix_select === 'risque') {
            $am->cause_id = null;
            $am->risque_id = $risqueSelect_id;
        }
        $am->update();

        $suppr_suivi = Suivi_amelioration::where('amelioration_id', $am->id)->delete();

        foreach ($nature as $index => $valeur) {

            if ($nature[$index] === 'accepte') {

                $suivic = new Suivi_amelioration();
                $suivic->type = 'action';
                $suivic->nature = $nature[$index];
                $suivic->statut = 'non-realiser';
                $suivic->amelioration_id = $am->id;
                $suivic->action_id = $action_id[$index];
                $suivic->commentaire_am = $commentaire[$index];
                $suivic->save();

            } else if ($nature[$index] === 'non-accepte') {

                $actionn = new Action();
                $actionn->action = $naction[$index];
                $actionn->page = 'am';
                $actionn->type = 'corrective';
                $actionn->poste_id = $poste_id[$index];
                $actionn->risque_id = $risque[$index];
                $actionn->save();

                $suivic = new Suivi_amelioration();
                $suivic->type = 'action_am';
                $suivic->nature = $nature[$index];
                $suivic->statut = 'non-realiser';
                $suivic->amelioration_id = $am->id;
                $suivic->action_id = $actionn->id;
                $suivic->commentaire_am = $commentaire[$index];
                $suivic->save();

            }

        }

        if ($am) {

            $his = new Historique_action();
            $his->nom_formulaire = 'Fiche d\'incident non validé';
            $his->nom_action = 'mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()->route('index_amup')->with('success', 'Mise à jour éffectuée.');

        } else {
            return redirect()->route('index_amup')->with('error', 'Echec de la mise à jour');
        }
    }

    public function am_update($id)
    {
        $valide = Amelioration::where('id', $id)->first();

        if ($valide)
        {
            $valide->statut = 'update';
            $valide->update();

            $his = new Historique_action();
            $his->nom_formulaire = 'Fiche d\'incident non validé';
            $his->nom_action = 'Validation de la mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()
                    ->back()
                    ->with('success', 'Validation de la mise à jour éffectuée.');

        }

        return redirect()
            ->back()
            ->with('error', 'Validation de la mise à jour a échoué.');
    }

    public function am_delete($id)
    {
        $delete1 = rejet_am::where('amelioration_id', '=', $id)->delete();

        $delete2 = suivi_amelioration::where('amelioration_id', '=', $id)->delete();

        $delete3 = amelioration::where('id', '=', $id)->delete();

        if($delete1 && $delete2 && $delete3 )
        {
            return redirect()->back()->with('success', 'Suppression éffectuée.');
        }

        return redirect()->back()->with('error', 'Echec de la Suppression.');
    }
    
}
