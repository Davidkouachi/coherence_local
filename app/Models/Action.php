<?php

namespace App\Models;

use App\Models\Risque;
use App\Models\Resva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'action',
        'type',
        'page',
        'date',
        'poste_id',
        'risque_id',
    ];

    public function poste()
    {
        return $this->belongsTo(Poste::class, 'poste_id');
    }

    public function risque()
    {
        return $this->belongsTo(Risque::class, 'risque_id');
    }
}
