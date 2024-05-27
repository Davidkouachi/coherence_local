<?php

namespace App\Models;

use App\Models\Processus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risque extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'page',
        'vraisemblence',
        'gravite',
        'evaluation',
        'cout',
        'vraisemblence_residuel',
        'gravite_residuel',
        'evaluation_residuel',
        'cout_residuel',
        'date_validation',
        'processus_id',
        'statut',
        'traitement',
        'poste_id',
    ];

    public function processus()
    {
        return $this->belongsTo(Processuse::class, 'processus_id');
    }

    public function poste()
    {
        return $this->belongsTo(Poste::class, 'poste_id');
    }
}
