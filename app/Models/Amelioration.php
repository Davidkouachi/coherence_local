<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amelioration extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type',
        'date_fiche',
        'date_limite',
        'nbre_jour',
        'date_cloture1',
        'lieu',
        'detecteur',
        'non_conformite',
        'consequence',
        'cause',
        'choix_select',
        'statut',
        'date_validation',
        'date1',
        'date2',
        'efficacite',
        'commentaire_eff',
        'date_eff',
        'cause_id',
        'risque_id',
    ];

    public function risque()
    {
        return $this->belongsTo(Risque::class, 'risque_id');
    }

    public function cause()
    {
        return $this->belongsTo(Cause::class, 'cause_id');
    }

}
