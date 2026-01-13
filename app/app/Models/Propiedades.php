<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
