<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suivi_action extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'efficacite',
        'commentaire',
        'date_action',
        'date_suivi',
        'statut',
        'action_id',
    ];
    
    public function action()
    {
        return $this->belongsTo(Action::class, 'action_id');
    }
}
