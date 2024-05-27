<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color_interval extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nbre1',
        'nbre2',
        'color',
        'code_color',
    ];
}
