<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdf_file extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'pdf_nom',
        'pdf_chemin',
        'risque_id',
    ];

    public function risque()
    {
        return $this->belongsTo(Risque::class, 'risque_id');
    }
}
