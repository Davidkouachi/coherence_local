<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rejet_am extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'motif',
        'amelioration_id',
    ];

    public function amelioration()
    {
        return $this->belongsTo(Amelioration::class, 'amelioration_id');
    }
}
