<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anio extends Model
{
    protected $table = 'anios';
    protected $fillable = ['anio'];

    public function semanas()
    {
        return $this->hasMany(Semana::class);
    }
}
