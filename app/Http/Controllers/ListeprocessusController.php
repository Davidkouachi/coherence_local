<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Processuse;
use App\Models\Objectif;
use App\Models\Resva;
use App\Models\Risque;
use App\Models\Cause;
use App\Models\Rejet;
use App\Models\Action;
use App\Models\Suivi_action;
use App\Models\Poste;
use App\Models\User;
use App\Models\Amelioration;
use App\Models\Historique;
use App\Models\Pdf_file;
use App\Models\Pdf_file_processus;
use App\Events\NotificationEvent;
use App\Models\Historique_action;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ListeprocessusController extends Controller
{
    public function index_listeprocessus()
    {
        $processus = Processuse::all();

        $objectifData = [];
        $risqueData = [];


        $nbre_total = Amelioration::all()->count();

        foreach ($processus as $processu) {

            $pdf = Pdf_file_processus::where('processus_id', $processu->id)->first();
            if ($pdf) {
                $processu->pdf_nom = $pdf->pdf_nom;
                $processu->pdf_chemin = $pdf->pdf_chemin;
            } else {
                // Gérer le cas où aucun enregistrement n'est trouvé
                $processu->pdf_nom = null;
                $processu->pdf_chemin = null; // Ou définissez-le comme vous le souhaitez
            }

            $processu->nbre_risque = Risque::where('processus_id', $processu->id)->where('page', 'risk')->count();
            
            $objectifs = Objectif::where('processus_id', $processu->id)->get();

            $processu->nbre_objectif = count($objectifs);

            $objectifData[$processu->id] = [];
            foreach($objectifs as $objectif)
            {
                $objectifData[$processu->id][] = [
                    'objectif' => $objectif->nom,
                    'id' => $objectif->id,
                ];
            }

            $risques = Risque::where('processus_id', $processu->id)->where('page', 'risk')->get();

            $risqueData[$processu->id] = [];
            foreach($risques as $risque)
            {
                $risqueData[$processu->id][] = [
                    'risque' => $risque->nom,
                ];
            }

            $processu->nbre = Amelioration::join('risques', 'ameliorations.risque_id', 'risques.id')
                                        ->join('processuses', 'risques.processus_id', 'processuses.id')
                                        ->where('processuses.id', $processu->id)
                                        ->count();

            if ($nbre_total != 0) {
                $processu->progress = ($processu->nbre / $nbre_total) * 100;
                $processu->progress = number_format($processu->progress, 2);
            } else {
                // Handle the case where $nbre_total is zero (optional)
                $processu->progress = 0; // Set progress to zero or any other appropriate value
            }
        }

        return view('liste.processus', ['processus' => $processus, 'objectifData' => $objectifData, 'risqueData' => $risqueData]);
    }

    public function index_processus_modif(Request $request)
    {
        $processu = Processuse::find($request->id);

        $objectifData = [];

        if ($processu) {

            $pdf = Pdf_file_processus::where('processus_id', $processu->id)->first();
            if ($pdf) {
                $processu->pdf_nom = $pdf->pdf_nom;
                $processu->pdf_chemin = $pdf->pdf_chemin;
            } else {
                // Gérer le cas où aucun enregistrement n'est trouvé
                $processu->pdf_nom = null;
                $processu->pdf_chemin = null; // Ou définissez-le comme vous le souhaitez
            }

            $processu->nbre = Objectif::where('processus_id', $processu->id)->count();
            $objectifs = Objectif::where('processus_id', $processu->id)->get();

            $objectifData[$processu->id] = [];
            foreach($objectifs as $objectif)
            {
                $objectifData[$processu->id][] = [
                    'objectif' => $objectif->nom,
                    'id' => $objectif->id,
                ];
            }
        }

        $pdfFiles = Pdf_file_processus::all();

        return view('liste.processus_modif', ['processu' => $processu, 'objectifData' => $objectifData, 'pdfFiles' => $pdfFiles]);
    }

    public function processus_modif(Request $request)
    {
        //dd($request->all());

        $nomProcessus = $request->input('nprocessus');
        $descriptionProcessus = $request->input('description');
        $finalite = $request->input('finalite');

        $processus = Processuse::find($request->id);
        $processus->nom = $nomProcessus;
        $processus->description = $descriptionProcessus;
        $processus->finalite = $finalite;
        $processus->update();

        if ($request->hasFile('pdfFile') && $request->file('pdfFile')->isValid()) {

            $originalFileName = $request->file('pdfFile')->getClientOriginalName();
            $pdfPathname = $request->file('pdfFile')->storeAs('public/pdf', $originalFileName);

            // Enregistrez le fichier PDF dans la base de données
            $pdfFile = Pdf_file_processus::where('processus_id', $request->id)->first();

            if($pdfFile){

                $pdfFile->pdf_nom = $originalFileName;
                $pdfFile->pdf_chemin = $pdfPathname;
                $pdfFile->processus_id = $processus->id;
                $pdfFile->update();
            }else {

                $pdfFile = new Pdf_file_processus();
                $pdfFile->pdf_nom = $originalFileName;
                $pdfFile->pdf_chemin = $pdfPathname;
                $pdfFile->processus_id = $processus->id;
                $pdfFile->save();
            }
            
        }

        $objectifs = $request->input('objectifs');
        $id_objectifs = $request->input('id_objectifs');

        foreach ($id_objectifs as $index => $valeur) {

            if ($id_objectifs[$index] === '0') {

                $nouvelObjectif = new Objectif();
                $nouvelObjectif->processus_id = $request->id;
                $nouvelObjectif->nom = $objectifs[$index];
                $nouvelObjectif->save();
            }else {
                $rech = Objectif::find($id_objectifs[$index]);
                if ($rech) {

                    $rech->nom = $objectifs[$index];
                    $rech->update();
                }
            }
        }

        $id_suppr = $request->input('id_suppr');
        $suppr = $request->input('suppr');
        
        if ($suppr && is_array($suppr)) {
            foreach ($suppr as $index => $valeur) {
                if ($valeur === 'oui' && isset($id_suppr[$index])) {
                    $delete = Objectif::where('id', $id_suppr[$index])->delete();
                }
            }
        }

        if ($processus)
        {
            $his = new Historique_action();
            $his->nom_formulaire = 'Liste des Processus';
            $his->nom_action = 'Mise à jour';
            $his->user_id = Auth::user()->id;
            $his->save();

            return redirect()->route('index_listeprocessus')->with('success', 'Mise à jour éffectuée.');
        }

        return redirect()->route('index_listeprocessus')->with('error', 'Echec de la mise à jour.');
    }
    
}
