<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Poste;
use App\Models\Autorisation;
use App\Models\Color_para;
use App\Models\Color_interval;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PosteSeeder::class);

/*---Paramétrage des user de base -----------------------------------------------------------------------------*/

        $poste1 = Poste::where('nom', 'CONTRÔLEUR')->first();

        $user = User::create([
            'name' => 'David Kouachi',
            'email' => 'david@gmail.com',
            'password' => bcrypt('David001'),
            'matricule' => 'C1223456',
            'tel' => '0585782723',
            'poste_id' => $poste1->id,
            'suivi_active' => 'non',
            'fa' => 'non',
        ]);

        $auto = Autorisation::create([
            'new_user' => 'oui',
            'list_user' => 'oui',
            'new_poste' => 'oui',
            'list_poste' => 'oui',
            'historiq' => 'oui',
            'stat' => 'oui',

            'new_proces' => 'oui',
            'list_proces' => 'oui',
            'eva_proces' => 'oui',

            'new_risk' => 'oui',
            'list_risk' => 'oui',
            'val_risk' => 'oui',
            'act_n_val' => 'oui',
            'color_para' => 'oui',

            'list_cause' => 'oui',

            'suivi_actp' => 'oui',
            'list_actp' => 'oui',

            'suivi_actc' => 'oui',
            'list_actc_eff' => 'oui',
            'list_actc' => 'oui',

            'fiche_am' => 'oui',
            'list_am' => 'oui',
            'val_am' => 'oui',
            'am_n_val' => 'oui',
            
            'user_id' => $user->id,
        ]);

        /*---------------------------------------------------------------*/

        $poste2 = Poste::where('nom', 'OPÉRATEUR DE SAISIE')->first();

        $user2 = User::create([
            'name' => 'David Chris',
            'email' => 'chris@gmail.com',
            'password' => bcrypt('Chris001'),
            'matricule' => 'C12334490',
            'tel' => '0585782725',
            'poste_id' => $poste2->id,
            'suivi_active' => 'non',
            'fa' => 'non',
        ]);

        $auto2 = Autorisation::create([
            'new_user' => 'oui',
            'list_user' => 'oui',
            'new_poste' => 'oui',
            'list_poste' => 'oui',
            'historiq' => 'oui',
            'stat' => 'oui',

            'new_proces' => 'oui',
            'list_proces' => 'oui',
            'eva_proces' => 'oui',

            'new_risk' => 'oui',
            'list_risk' => 'oui',
            'val_risk' => 'oui',
            'act_n_val' => 'oui',
            'color_para' => 'oui',

            'list_cause' => 'oui',

            'suivi_actp' => 'oui',
            'list_actp' => 'oui',

            'suivi_actc' => 'oui',
            'list_actc_eff' => 'oui',
            'list_actc' => 'oui',

            'fiche_am' => 'oui',
            'list_am' => 'oui',
            'val_am' => 'oui',
            'am_n_val' => 'oui',
            
            'user_id' => $user2->id,
        ]);

        /*---------------------------------------------------------------*/

        $poste3 = Poste::where('nom', 'ADMINISTRATEUR')->first();

        $user3 = User::create([
            'name' => 'David Emmanuel',
            'email' => 'emmanuel@gmail.com',
            'password' => bcrypt('Emman001'),
            'matricule' => 'C12345491',
            'tel' => '0585782720',
            'poste_id' => $poste3->id,
            'suivi_active' => 'non',
            'fa' => 'non',
        ]);

        $auto3 = Autorisation::create([
            'new_user' => 'oui',
            'list_user' => 'oui',
            'new_poste' => 'oui',
            'list_poste' => 'oui',
            'historiq' => 'oui',
            'stat' => 'oui',

            'new_proces' => 'oui',
            'list_proces' => 'oui',
            'eva_proces' => 'oui',

            'new_risk' => 'oui',
            'list_risk' => 'oui',
            'val_risk' => 'oui',
            'act_n_val' => 'oui',
            'color_para' => 'oui',

            'list_cause' => 'oui',

            'suivi_actp' => 'oui',
            'list_actp' => 'oui',

            'suivi_actc' => 'oui',
            'list_actc_eff' => 'oui',
            'list_actc' => 'oui',

            'fiche_am' => 'oui',
            'list_am' => 'oui',
            'val_am' => 'oui',
            'am_n_val' => 'oui',
            
            'user_id' => $user3->id,
        ]);

        /*---------------------------------------------------------------*/

        $poste4 = Poste::where('nom', 'PRODUCTION')->first();

        $user4 = User::create([
            'name' => 'Chris Emmanuel',
            'email' => 'chris01@gmail.com',
            'password' => bcrypt('Chris01001'),
            'matricule' => 'C1234951',
            'tel' => '0585782520',
            'poste_id' => $poste4->id,
            'suivi_active' => 'non',
            'fa' => 'non',
        ]);

        $auto4 = Autorisation::create([
            'new_user' => 'oui',
            'list_user' => 'oui',
            'new_poste' => 'oui',
            'list_poste' => 'oui',
            'historiq' => 'oui',
            'stat' => 'oui',

            'new_proces' => 'oui',
            'list_proces' => 'oui',
            'eva_proces' => 'oui',

            'new_risk' => 'oui',
            'list_risk' => 'oui',
            'val_risk' => 'oui',
            'act_n_val' => 'oui',
            'color_para' => 'oui',

            'list_cause' => 'oui',

            'suivi_actp' => 'oui',
            'list_actp' => 'oui',

            'suivi_actc' => 'oui',
            'list_actc_eff' => 'oui',
            'list_actc' => 'oui',

            'fiche_am' => 'oui',
            'list_am' => 'oui',
            'val_am' => 'oui',
            'am_n_val' => 'oui',
            
            'user_id' => $user4->id,
        ]);

        /*---------------------------------------------------------------*/

        $poste5 = Poste::where('nom', 'VALIDATEUR')->first();

        $user5 = User::create([
            'name' => 'Chris Kouachi',
            'email' => 'chrisK@gmail.com',
            'password' => bcrypt('ChrisK001'),
            'matricule' => 'C1234904',
            'tel' => '0555782520',
            'poste_id' => $poste5->id,
            'suivi_active' => 'non',
            'fa' => 'non',
        ]);

        $auto5 = Autorisation::create([
            'new_user' => 'oui',
            'list_user' => 'oui',
            'new_poste' => 'oui',
            'list_poste' => 'oui',
            'historiq' => 'oui',
            'stat' => 'oui',

            'new_proces' => 'oui',
            'list_proces' => 'oui',
            'eva_proces' => 'oui',

            'new_risk' => 'oui',
            'list_risk' => 'oui',
            'val_risk' => 'oui',
            'act_n_val' => 'oui',
            'color_para' => 'oui',

            'list_cause' => 'oui',

            'suivi_actp' => 'oui',
            'list_actp' => 'oui',

            'suivi_actc' => 'oui',
            'list_actc_eff' => 'oui',
            'list_actc' => 'oui',

            'fiche_am' => 'oui',
            'list_am' => 'oui',
            'val_am' => 'oui',
            'am_n_val' => 'oui',
            
            'user_id' => $user5->id,
        ]);

/*-------------------------------------------------------------------------------------------------------------*/

/*---Paramétrage couleur de base -----------------------------------------------------------------------------*/

        $color_para = Color_para::create([
            'nbre0' => '0',
            'nbre1' => '1',
            'nbre2' => '5',
            'nbre_color' => '4',
            'operation' => 'multiplication',
        ]);

        $color_interval1 = Color_interval::create([
            'nbre1' => '1',
            'nbre2' => '5',
            'color' => 'vert',
            'code_color' => '#5eccbf',
        ]);

        $color_interval2 = Color_interval::create([
            'nbre1' => '6',
            'nbre2' => '10',
            'color' => 'jaune',
            'code_color' => '#f7f880',
        ]);

        $color_interval3 = Color_interval::create([
            'nbre1' => '11',
            'nbre2' => '15',
            'color' => 'orange',
            'code_color' => '#f2b171',
        ]);

        $color_interval4 = Color_interval::create([
            'nbre1' => '16',
            'nbre2' => '25',
            'color' => 'rouge',
            'code_color' => '#ea6072',
        ]);

/*-------------------------------------------------------------------------------------------------------*/
    }

}
