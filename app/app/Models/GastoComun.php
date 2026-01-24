<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastoComun extends Model
{
    use HasFactory;

    protected $table = 'gastos_comunes';

    protected $fillable = [
        'propiedad_id',
        'user_id',
        'anio',
        'mes',
        'monto',
        'estado',
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedades::class, 'propiedad_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
