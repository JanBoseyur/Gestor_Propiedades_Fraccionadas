<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GastoComun extends Model
{
    protected $table = 'gastos_comunes';

    protected $fillable = [
        'propiedad_id',
        'usuario_id', 
        'anio',
        'mes',
        'semana',
        'monto',
        'estado',
    ];

    public function propiedad()
    {
        return $this->belongsTo(\App\Models\Propiedades::class, 'propiedad_id');
    }

    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }
}
