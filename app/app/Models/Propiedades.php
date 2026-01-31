<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Propiedades extends Model
{
    protected $table = 'propiedades';

    public function up(): void
    {
        Schema::create('propiedades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150)->nullable();
            $table->string('ubicacion', 100);
            $table->string('descripcion', 200);
            $table->json('fotos')->nullable();
            $table->json('amenidades')->nullable();
        });
    }

    public function amenidades()
    {
        return $this->belongsToMany(
            Amenidad::class,
            'amenidad_propiedad',
            'propiedad_id',
            'amenidad_id'
        );
    }

    public function usuarios()
    {
        return $this->belongsToMany(
            User::class,
            'usuario_propiedad',
            'id_propiedad',
            'id_usuario'
        );
    }
    
    public function semanas()
    {
        return $this->hasMany(
            \App\Models\PropiedadSemana::class,
            'propiedad_id', 
            'id'           
        );
    }

    public function gastosComunes()
    {
        return $this->hasMany(GastoComun::class);
    }

    protected $casts = [
        'fotos' => 'array',
        'amenidades' => 'array',
    ];

    public function getPrimeraFotoAttribute()
    {
        return $this->fotos[0] ?? null;
    }

    public function selections()
    {
        return $this->hasMany(Selection::class, 'propiedad_id', 'id');
    }

}
