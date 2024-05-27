<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Events\NotificationAcorrective;
use App\Events\NotificationAmnew;

use App\Models\Processuse;
use App\Models\Objectif;
use App\Models\Resva;
use App\Models\Risque;
use App\Models\Cause;
use App\Models\Rejet;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\Suivi_amelioration;
use App\Models\Poste;
use App\Models\User;
use App\Models\Amelioration;
use App\Models\Causetrouver;
use App\Models\Risquetrouver;
use App\Models\Historique_action;
use App\Models\Color_para;
use App\Models\Color_interval;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ListecauseController extends Controller
{
    public function index()
    {
        $causes = cause::join('risques', 'causes.risque_id', 'risques.id')
                        ->join('processuses', 'risques.processus_id', 'processuses.id')
                        ->where('risques.statut', 'valider')
                        ->where('causes.page', 'risk')
                        ->select('causes.*','risques.nom as risque', 'risques.statut as statut', 'processuses.nom as processus')
                        ->get();

        $nbre_total = Amelioration::all()->count();

        $nbreData = [];

        foreach ($causes as $key => $cause) {

            if($nbre_total > 0){

                $cause->nbre = Amelioration::where('cause_id', $cause->id)->where('choix_select', 'cause')->count();;
                $cause->progess = ($cause->nbre / $nbre_total) * 100;
                $cause->progess = number_format($cause->progess, 2);

            }else{
                
                $cause->progess = 0;

            }

        }

        return view('liste.cause', ['causes' => $causes]);
    }

    public function cause_modif(Request $request)
    {

        $cause = $request->input('cause');

        $rech = Cause::find($request->id);

        if ($rech)
        {
            $rech->nom = $cause;
            $rech->update();

            $his = new Historique_action();
            $his->nom_formulaire = 'Liste des causes';
            $his->nom_action = 'Mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()->back()->with('success', 'Mise à jour éffectuée.');
        }

        return redirect()->back()->with('error', 'Echec de la mise à jour.');
    }
}
