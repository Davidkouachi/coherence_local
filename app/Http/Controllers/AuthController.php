<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use App\Models\Historique_action;
use App\Models\Poste;
use App\Models\Autorisation;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {

            return view('add.processus');

        } else {

            return redirect()->route('login');

        }
    }
    
    public function view_login()
    {
        Cache::flush();
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('info', 'Vous avez été déconnecté avec succès.');
    }

    public function auth_user(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            Session::forget('url.intended');
            //Auth::logoutOtherDevices($request->password);
            
            $poste_id = Auth::user()->poste_id;
            $user_id = Auth::user()->id;

            $poste = Poste::find($poste_id);
            if ($poste) {
                session(['user_poste' => $poste]);
            }

            $auto = Autorisation::where('user_id', $user_id)->first();
            if ($auto) {
                session(['user_auto' => $auto]);
            }

            return redirect()->intended(route('index_accueil'))->with('success', 'Connexion réussi.');
        }

        return redirect()->back()->withInput(['email' => $request->input('email'), 'password' => $request->input('password')])->with([
            'error_login' => 'L\'authentification a échoué. Veuillez vérifier vos informations d\'identification et réessayer.',
        ]);
    }

}
