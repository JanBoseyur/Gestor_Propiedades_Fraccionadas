<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    protected $table = 'selections';

    protected $fillable = [
        'propiedad_id',
        'id_usuario',
        'anio',
        'semana',
    ];

    protected $casts = [
        'semana' => 'array', 
    ];
}