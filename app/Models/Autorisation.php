<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autorisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'new_user',
        'list_user',
        'new_poste',
        'list_poste',
        'historiq',
        'stat',
        'new_proces',
        'list_proces',
        'eva_proces',
        'new_risk',
        'list_risk',
        'val_risk',
        'act_n_val',
        'color_para',
        'list_cause',
        'suivi_actp',
        'list_actp',
        'suivi_actc',
        'list_actc_eff',
        'list_actc',
        'fiche_am',
        'list_am',
        'val_am',
        'am_n_val',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
