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
use App\Models\Pdf_file;
use App\Models\Pdf_file_processus;
use App\Models\User;
use App\Models\Historique_action;
use App\Models\Poste;
use App\Models\Color_para;
use App\Models\Color_interval;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Twilio\Rest\Client;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Illuminate\Support\Facades\Session;

class ParamettreController extends Controller
{
    public function index_color_risk()
    {
        $color_para = Color_para::where('nbre0', '=', '0')->first();
        $color_intervals = Color_interval::orderBy('nbre1', 'asc')->get();
        $color_interval_nbre = count($color_intervals);

        return view('add.color_risque',[
            'color_para' => $color_para,
            'color_intervals' => $color_intervals,
            'color_interval_nbre' => $color_interval_nbre,
        ]);
    }

    public function color_para_traitement(Request $request)
    {
        $color_para = Color_para::where('nbre0', '=', '0')->first();
        $color_nbre = Color_interval::all()->count();

        if ($request->operation != $color_para->operation || $request->nbre_color < $color_nbre) {
            Color_interval::truncate();
        }

        $color_para->nbre1 = $request->nbre1;
        $color_para->nbre2 = $request->nbre2;
        $color_para->nbre_color = $request->nbre_color;
        $color_para->operation = $request->operation;

        if ($color_para->save()) {

            $his = new Historique_action();
            $his->nom_formulaire = 'Paramettrage de couleurs';
            $his->nom_action = 'Nouveaux paramettre';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()->back()->with(['success' => 'Mise à jour effectuée.']);
        }

        return redirect()->back()->with(['error' => 'Échec de la mise à jour.']);
    }

    public function color_interval_add_traitement(Request $request)
    {

        if ( $request->nbre1 >= $request->nbre2){
            return redirect()->back()->with(['info' => 'le deuxieme nombre doit toujours etre supérieur.']);
        }

        $color_intervals = Color_interval::all();

        $overlapDetected = false;

        foreach ($color_intervals as $value) {
            if (
                ($value->nbre1 <= $request->nbre1 && $request->nbre1 <= $value->nbre2) ||
                ($value->nbre1 <= $request->nbre2 && $request->nbre2 <= $value->nbre2) ||
                ($request->nbre1 <= $value->nbre1 && $value->nbre2 <= $request->nbre2)
            ) {
                $overlapDetected = true;
                break; // Sortir de la boucle dès qu'un chevauchement est trouvé
            }
        }

        if ($overlapDetected) {
            return redirect()->back()->with(['error' => 'Enregistrement impossible.']);
        }


        $color_interval = new Color_interval();
        $color_interval->nbre1 = $request->nbre1;
        $color_interval->nbre2 = $request->nbre2;
        $color_interval->color = $request->color;

        if($request->color === 'vert'){
            $color_interval->code_color = '#5eccbf';
        }elseif($request->color === 'jaune'){
            $color_interval->code_color = '#f7f880';
        }elseif($request->color === 'orange'){
            $color_interval->code_color = '#f2b171';
        }elseif($request->color === 'rouge'){
            $color_interval->code_color = '#ea6072';
        }

        if($color_interval->save()) {

            $his = new Historique_action();
            $his->nom_formulaire = 'Paramettrage des couleurs';
            $his->nom_action = 'Nouvel intervale ajouter';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()->back()->with(['success' => 'Nouvel interval ajouté.']);
        }

        return redirect()->back()->with(['error' => 'Echec.']);
    }

    public function color_interval_delete_traitement($id)
    {
        $delete = Color_interval::find($id);
        $delete->delete();
        
        if($delete) {

            $his = new Historique_action();
            $his->nom_formulaire = 'Paramettrage des couleurs';
            $his->nom_action = 'Suppression d\'un interval ';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()->back()->with(['success' => 'Suppression éffectuée.']);
        }

        return redirect()->back()->with(['error' => 'Echec de la suppression.']);
    }
    
}
