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

    public function propiedad()
    {
        return $this->belongsTo(Propiedades::class, 'propiedad_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function getSemanaAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }

        return [];
    }
}
