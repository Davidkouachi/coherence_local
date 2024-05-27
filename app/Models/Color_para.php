<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color_para extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nbre0',
        'nbre1',
        'nbre2',
        'nbre_color',
        'operation',
    ];
}
