<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Twilio\Rest\Client;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ProfilController extends Controller
{
    public function index_profil() 
    {
        return view('user.profil');
    }

    public function suivi_oui()
    {
        $user = User::find(Auth::user()->id);
        $user->suivi_active = 'oui';
        $user->update();

        if ($user && Auth::check()) {
            Auth::user()->suivi_active = 'oui';
            Auth::user()->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => true]);
    }

    public function suivi_non()
    {
        $user = User::find(Auth::user()->id);
        $user->suivi_active = 'non';
        $user->update();

        if ($user && Auth::check()) {
            Auth::user()->suivi_active = 'non';
            Auth::user()->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => true]);
    }

    public function mdp_update(Request $request)
    {
        if( $request->password !== $request->password2){
            return back()->with('error' , 'Mot de passe incorrecte');
        }

        $user = User::find(Auth::user()->id);

        if ($user) {
            $user->update([
                'password' => bcrypt($request->password),
                'mdp_date' => now(),
            ]);

            return back()->with('success' , 'Mot de passe modifié');
        }

        return back()->with('error' , 'Echec de la modification');
    }

    public function info_update(Request $request)
    {
        $name = $request->input('name');
        $tel = $request->input('tel');
        $email = $request->input('email');

        $user = User::find(Auth::user()->id);
        $user->name = $name;
        $user->tel = $tel;
        $user->email = $email;
        $user->update();

        if ($user) {

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => true]);
    }

}
