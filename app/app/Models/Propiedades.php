<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Propiedades extends Model
{
    protected $table = 'propiedades';

    public function amenidades()
    {
        return $this->belongsToMany(
            Amenidad::class,
            'amenidad_propiedad',
            'propiedad_id',
            'amenidad_id'
        );
    }

    public function socios()
    {
        return $this->belongsToMany(
            User::class,
            'usuario_propiedad',
            'id_propiedad', 
            'id_usuario'   
        );
    }
}
