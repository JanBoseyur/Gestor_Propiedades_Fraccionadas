<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Semana extends Model
{
    use HasFactory;

    protected $table = 'semanas';

    protected $fillable = [
        'anio_id',
        'numero_semana',
        'estado'
    ];

    // Una semana puede estar asignada a una propiedad
    public function propiedad()
    {
        return $this->belongsToMany(
            Propiedades::class,
            'propiedad_semana',
            'semana_id',
            'propiedad_id'
        );
    }

    public function propiedades()
    {
        return $this->hasMany(PropiedadSemana::class);
    }

    public function anio()
    {
        return $this->belongsTo(\App\Models\Anio::class, 'anio_id', 'id');
    }

    public function fechaInicio()
    {
        return Carbon::now()
            ->setISODate($this->anio->anio, $this->numero_semana)
            ->startOfWeek(Carbon::MONDAY);
    }

    public function fechaFin()
    {
        return Carbon::now()
            ->setISODate($this->anio->anio, $this->numero_semana)
            ->endOfWeek(Carbon::SUNDAY);
    }
}
