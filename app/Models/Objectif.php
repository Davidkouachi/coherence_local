<?php

namespace App\Models;

use App\Models\Processus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objectif extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'processus_id',
    ];

    public function processus()
    {
        return $this->belongsTo(Processus::class, 'processus_id');
    }
}

