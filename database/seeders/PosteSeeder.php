<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poste;

class PosteSeeder extends Seeder
{

    public function run()
    {
        Poste::create(['nom' => 'CONTRÔLEUR', 'occupe' => 'oui']);
        Poste::create(['nom' => 'OPÉRATEUR DE SAISIE', 'occupe' => 'oui']);
        Poste::create(['nom' => 'ADMINISTRATEUR', 'occupe' => 'oui']);
        Poste::create(['nom' => 'PRODUCTION', 'occupe' => 'oui']);
        Poste::create(['nom' => 'VALIDATEUR', 'occupe' => 'oui']);
    }
}
