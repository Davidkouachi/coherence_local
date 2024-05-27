<?php

namespace App\Models;

use App\Models\Risque;
use App\Models\Resva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'page',
        'dispositif',
        'risque_id',
    ];

    public function risque()
    {
        return $this->belongsTo(Risque::class, 'risque_id');
    }

}
