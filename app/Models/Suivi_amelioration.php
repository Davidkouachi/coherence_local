<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suivi_amelioration extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'efficacite',
        'nature',
        'type',
        'commentaire',
        'commentaire_am',
        'date_action',
        'date_suivi',
        'statut',
        'amelioration_id',
        'action_id',
    ];

    public function amelioration()
    {
        return $this->belongsTo(Amelioration::class, 'amelioration_id');
    }

    public function action()
    {
        return $this->belongsTo(Action::class, 'action_id');
    }

}
