<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProcessusController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuiviactionController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\AmeliorationController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\ListeprocessusController;
use App\Http\Controllers\ListerisqueController;
use App\Http\Controllers\ListecauseController;
use App\Http\Controllers\ListeactionController;
use App\Http\Controllers\EtatController;
use App\Http\Controllers\ListeamController;
use App\Http\Controllers\ListeuserController;
use App\Http\Controllers\Updateamcontroller;
use App\Http\Controllers\ParamettreController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\RisqueController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\PanelController;


/*--Connexion---------------------------------------------------------------------------------------------------------------*/
    Route::get('/Login', [AuthController::class, 'view_login'])->name('login');
    Route::post('/auth_user', [AuthController::class, 'auth_user']);
/*----------------------------------------------------------------------------------------------------------------------------*/

/*--Erreur---------------------------------------------------------------------------------------------------------------*/
    Route::get('/Erreur', [Controller::class, 'errorData'])->name('errorData');
/*------------------------------------------------------------------------------------------------------------------------*/

Route::middleware(['auth'])->group(function () {

    /*--Acceuil-------------------------------------------------------------------------------------------------------------------*/
        Route::get('/', [Controller::class, 'index_accueil'])->name('index_accueil');
    /*----------------------------------------------------------------------------------------------------------------------------*/

    /*--Propos-------------------------------------------------------------------------------------------------------------------*/
        Route::get('/A propos', [Controller::class, 'index_propos'])->name('index_propos');
    /*----------------------------------------------------------------------------------------------------------------------------*/

    /*--Deconnexion---------------------------------------------------------------------------------------------------------------*/
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    /*----------------------------------------------------------------------------------------------------------------------------*/

    /*--Paramétrage de couleurs---------------------------------------------------------------------------------------------------*/
        Route::get('/Color paramettre', [ParamettreController::class, 'index_color_risk'])->name('index_color_risk');
        Route::post('/Color paramettre traitement', [ParamettreController::class, 'color_para_traitement'])->name('color_para_traitement');
        Route::post('/Color interval add traitement', [ParamettreController::class, 'color_interval_add_traitement'])->name('color_interval_add_traitement');
        Route::get('/Color_interval_delete_traitement/{id}', [ParamettreController::class, 'color_interval_delete_traitement'])->name('color_interval_delete_traitement');
    /*----------------------------------------------------------------------------------------------------------------------------*/

    /*--Profil-------------------------------------------------------------------------------------------------------------------*/
        Route::get('/Profil', [ProfilController::class, 'index_profil'])->name('index_profil');
        Route::get('/suiviactiveoui', [ProfilController::class, 'suivi_oui']);
        Route::get('/suiviactivenon', [ProfilController::class, 'suivi_non']);
        Route::post('/mdp_update', [ProfilController::class, 'mdp_update'])->name('mdp_update');
        Route::get('/info_update', [ProfilController::class, 'info_update']);
    /*----------------------------------------------------------------------------------------------------------------------------*/

    /*--Utilisateur-------------------------------------------------------------------------------------------------------------------*/
        Route::get('/Nouveau utilisateur', [UserController::class, 'index_user'])->name('index_user');
        Route::post('/traitement user', [UserController::class, 'add_user'])->name('add_user');
        Route::get('/Liste des utilisateurs', [ListeuserController::class, 'index'])->name('index_liste_user');
        Route::post('/Modification des autorisations', [ListeuserController::class, 'index_user_modif'])->name('index_user_modif');
        Route::post('/traitement modif user', [ListeuserController::class, 'index_modif_traitement'])->name('index_modif_auto');
    /*----------------------------------------------------------------------------------------------------------------------------*/

    /*--Processus-------------------------------------------------------------------------------------------------------------------*/
        Route::get('/Nouveau Processus', [ProcessusController::class, 'index_add_processus'])->name('index_add_processus');
        Route::post('/traitement processus', [ProcessusController::class, 'add_processus'])->name('add_processus');
        Route::get('/Liste Processus', [ListeprocessusController::class, 'index_listeprocessus'])->name('index_listeprocessus');
        Route::post('/modif processus', [ListeprocessusController::class, 'index_processus_modif'])->name('index_processus_modif');
        Route::post('/traitement modif processus', [ListeprocessusController::class, 'processus_modif'])->name('processus_modif');
        Route::get('/Evaluation des processus', [EvaluationController::class, 'index_processus'])->name('index_evaluation_processus');
    /*----------------------------------------------------------------------------------------------------------------------------*/

    /*--Poste---------------------------------------------------------------------------------------------------------------------*/
        Route::get('/Liste Poste', [PosteController::class, 'index_liste_poste'])->name('index_liste_poste');
        Route::post('/traitement Poste', [PosteController::class, 'index_add_poste_traitement'])->name('index_add_poste_traitement');
        Route::post('/traitement modif Poste', [PosteController::class, 'index_modif_poste_traitement'])->name('index_modif_poste_traitement');
        Route::get('/get post user', [PosteController::class, '/get_post_user'])->name('get_post_user');
        Route::get('/poste_delete/{id}', [PosteController::class, 'poste_delete'])->name('poste_delete');
    /*----------------------------------------------------------------------------------------------------------------------------*/

    /*--Risque---------------------------------------------------------------------------------------------------------------------*/
        Route::get('/Nouveau Risque', [RisqueController::class, 'index_risque'])->name('index_risque');
        Route::get('/recherche/{processusId}', [RisqueController::class, 'recherche_processus'])->name('recherche_processus');
        Route::post('/traitement_risque', [RisqueController::class, 'add_risque'])->name('add_risque');

        Route::get('/Validation des risques', [RisqueController::class, 'index_validation_risque'])->name('index_validation_risque');
        Route::get('/risque valider/{id}', [RisqueController::class, 'risque_valider'])->name('risque_valider');

        Route::post('/traitement rejet', [RisqueController::class, 'risque_rejet'])->name('risque_rejet');

        Route::get('/Liste risque', [ListerisqueController::class, 'index_liste_risque'])->name('index_liste_risque');
        Route::get('/Mise a jour', [ListerisqueController::class, 'index_risque_actionup'])->name('index_risque_actionup');
        Route::post('/Mise a jour risque', [ListerisqueController::class, 'index_risque_actionup2'])->name('index_risque_actionup2');
        Route::post('/Mise a jour risque traitement', [ListerisqueController::class, 'index_risque_actionup2_traitement'])->name('index_risque_actionup2_traitement');
        Route::get('/risque_delete/{id}', [ListerisqueController::class, 'risque_delete'])->name('risque_delete');
    /*----------------------------------------------------------------------------------------------------------------------------*/

    /*--Cause---------------------------------------------------------------------------------------------------------------------*/
        Route::get('/Liste des causes', [ListecauseController::class, 'index'])->name('liste_cause');
        Route::post('/cause_modif', [ListecauseController::class, 'cause_modif'])->name('cause_modif');
    /*----------------------------------------------------------------------------------------------------------------------------*/

    /*--Acton preventive---------------------------------------------------------------------------------------------------------*/
        Route::get('/Liste Action Preventive', [ListeactionController::class, 'index_ap'])->name('index_ap');
        Route::get('/Suivi des actions preventives', [SuiviactionController::class, 'index_suiviaction'])->name('index_suiviaction');
        Route::post('/Suivi_action/{id}', [SuiviactionController::class, 'add_suivi_action'])->name('add_suivi_action');
        Route::post('/actionp_modif', [ListeactionController::class, 'actionp_modif'])->name('actionp_modif');
    /*---------------------------------------------------------------------------------------------------------------------------*/

    /*--Acton corrective-------------------------------------------------------------------------------------------------------------*/
        Route::get('/Liste Action Corrective', [ListeactionController::class, 'index_ac'])->name('index_ac');
        Route::get('/Suivi des actions correctives', [SuiviactionController::class, 'index_suiviactionc'])->name('index_suiviactionc');
        Route::post('/Suivi_actionc/{id}', [SuiviactionController::class, 'add_suivi_actionc'])->name('add_suivi_actionc');
        Route::post('/actionc_modif', [ListeactionController::class, 'actionc_modif'])->name('actionc_modif');
    /*----------------------------------------------------------------------------------------------------------------------------*/

    /*--Incident-------------------------------------------------------------------------------------------------------------*/
        Route::get('/fiche_amelioration', [AmeliorationController::class, 'index'])->name('index_amelioration');
        Route::get('/get-cause-info/{id}', [AmeliorationController::class, 'get_cause_info']);
        Route::get('/get-risque-info/{id}', [AmeliorationController::class, 'get_risque_info']);
        Route::post('/add_amelioration', [AmeliorationController::class, 'index_add'])->name('index_add');
        Route::get('/liste_amelioration', [AmeliorationController::class, 'index_liste'])->name('index_amelioration_liste');
        Route::get('/validation_amelioration', [ListeamController::class, 'index_validation'])->name('index_validation_amelioration');
        Route::get('/am_valider/{id}', [ListeamController::class, 'am_valider'])->name('am_valider');
        Route::post('/am_rejet', [ListeamController::class, 'am_rejet'])->name('am_rejet');
        Route::get('/amelioration_up', [ListeamController::class, 'index_amup'])->name('index_amup');
        Route::post('/amelioration_up2', [ListeamController::class, 'index_amup2'])->name('index_amup2');
        Route::post('/amelioration_up_add', [ListeamController::class, 'index_amup_add'])->name('index_amup_add');
        Route::post('/amelioration_up_traitement', [Updateamcontroller::class, 'amup_traitement'])->name('amup_traitement');
        Route::post('/amelioration_up2_traitement', [Updateamcontroller::class, 'amup2_traitement'])->name('amup2_traitement');
        Route::post('/amelioration_up2_add_traitement', [Updateamcontroller::class, 'amup2_add_traitement'])->name('amup2_add_traitement');
        Route::post('/traitement_date', [AmeliorationController::class, 'date_recla'])->name('date_recla');
        Route::post('/traitement_eff', [AmeliorationController::class, 'eff_recla'])->name('eff_recla');
        Route::get('/am_update/{id}', [Updateamcontroller::class, 'am_update'])->name('am_update');
        Route::get('/am_delete/{id}', [Updateamcontroller::class, 'am_delete'])->name('am_delete');
    /*----------------------------------------------------------------------------------------------------------------------------*/   

    /*--Statistique---------------------------------------------------------------------------------------------------------------*/
        Route::get('/Statistique', [StatistiqueController::class, 'index_stat'])->name('index_stat');
        Route::get('/get_processus/{id}', [StatistiqueController::class, 'get_processus'])->name('get_processus');
        Route::get('/get_risque/{id}', [StatistiqueController::class, 'get_risque'])->name('get_risque');
        Route::get('/get_date', [StatistiqueController::class, 'get_date'])->name('get_date');  
    /*----------------------------------------------------------------------------------------------------------------------------*/  

    /*--Historique---------------------------------------------------------------------------------------------------------------*/
        Route::get('/Historique', [HistoriqueController::class, 'index_historique'])->name('index_historique');
    /*----------------------------------------------------------------------------------------------------------------------------*/ 

    /*--Etat---------------------------------------------------------------------------------------------------------------*/
        Route::post('/Etat am', [EtatController::class, 'index_etat_am'])->name('index_etat_am');
        Route::post('/Etat risque', [EtatController::class, 'index_etat_risque'])->name('index_etat_risque');
        Route::post('/Etat cause', [EtatController::class, 'index_etat_cause'])->name('index_etat_cause');
        Route::post('/Etat processus', [EtatController::class, 'index_etat_processus'])->name('index_etat_processus');
        Route::post('/Etat actionp', [EtatController::class, 'index_etat_actionp'])->name('index_etat_actionp');
        Route::post('/Etat actionc', [EtatController::class, 'index_etat_actionc'])->name('index_etat_actionc');
    /*----------------------------------------------------------------------------------------------------------------------------*/  
   
});




