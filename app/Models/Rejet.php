<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rejet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'motif',
        'risque_id',
    ];

    public function risque()
    {
        return $this->belongsTo(Risque::class, 'risque_id');
    }

}
