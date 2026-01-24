<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropiedadSemana extends Model
{
    protected $table = 'propiedad_semana';

    protected $fillable = [
        'propiedad_id',
        'semana_id',
        'usuario_id',
    ];

    public function semana()
    {
        return $this->belongsTo(\App\Models\Semana::class, 'semana_id', 'id');
    }

    public function propiedad()
    {
        return $this->belongsTo(\App\Models\Propiedades::class, 'propiedad_id', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id', 'id');
    }

}
