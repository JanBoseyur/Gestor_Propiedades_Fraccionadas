<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastoComun extends Model
{
    protected $table = 'gastos_comunes';

    protected $fillable = [
        'propiedad_id',
        'anio',
        'mes',
        'user_id',
        'monto',
        'estado',
        'fecha_pago',
    ];
}
