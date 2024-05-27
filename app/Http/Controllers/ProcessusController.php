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

class ProcessusController extends Controller
{
    public function index_add_processus()
    {
        $pdfFiles = Pdf_file_processus::all();
        $pdfFiles2 = Pdf_file::all();
        return view('add.processus',['pdfFiles' => $pdfFiles,'pdfFiles2' => $pdfFiles2]);
    }

    public function add_processus(Request $request)
    {

        $nomProcessus = $request->input('nprocessus');
        $descriptionProcessus = $request->input('description');
        $objectifs = $request->input('objectifs');
        $finalite = $request->input('finalite');

        $processus = new Processuse();
        $processus->nom = $nomProcessus;
        $processus->description = $descriptionProcessus;
        $processus->finalite = $finalite;
        $processus->save();

        if ($request->hasFile('pdfFile') && $request->file('pdfFile')->isValid()) {

            $originalFileName = $request->file('pdfFile')->getClientOriginalName();
            $pdfPathname = $request->file('pdfFile')->storeAs('public/pdf', $originalFileName);

            // Enregistrez le fichier PDF dans la base de données
            $pdfFile = new Pdf_file_processus();
            $pdfFile->pdf_nom = $originalFileName;
            $pdfFile->pdf_chemin = $pdfPathname;
            $pdfFile->processus_id = $processus->id;
            $pdfFile->save();
        }

        foreach ($objectifs as $objectif) {
            $nouvelObjectif = new Objectif();
            $nouvelObjectif->processus_id = $processus->id;
            $nouvelObjectif->nom = $objectif;
            $nouvelObjectif->save();
        }

        if ($processus)
        {
            $his = new Historique_action();
            $his->nom_formulaire = 'Nouveau Processus';
            $his->nom_action = 'Ajouter';
            $his->user_id = Auth::user()->id;
            $his->save();

            event(new NotificationProcessus());

            return back()
                    ->with('success', 'Enregistrement éffectuée.');
        }

        return back()
            ->with('error', 'Enregistrement a échoué.');
    }

}
