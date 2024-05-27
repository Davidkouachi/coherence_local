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
use App\Models\Suivi_amelioration;
use App\Models\User;
use App\Models\Historique_action;
use App\Models\Amelioration;

use App\Events\NotificationApreventive;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class HistoriqueController extends Controller
{
    public function index_historique()
    {

        $historiques = Historique_action::join('users', 'historique_actions.user_id', '=', 'users.id')
                ->join('postes', 'users.poste_id', '=', 'postes.id')
                ->orderBy('historique_actions.created_at', 'desc')
                ->select('historique_actions.*', 'postes.nom as poste', 'users.name as nom', 'users.matricule as matricule')
                ->get();

       return view('historique.historique', ['historiques' => $historiques]);
    }
}
