<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    protected $appends = ['rol_legible'];

    public function getRolLegibleAttribute(): string
    {
        if ($this->hasRole('admin')) {
            return 'Administrador';
        }

        if ($this->hasRole('user')) {
            return 'Usuario';
        }

        return 'Sin rol';
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',  
        'city',     
        'country',
        'phone',  
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function propiedades()
    {
        return $this->belongsToMany(
            Propiedades::class,
            'usuario_propiedad',
            'id_usuario',
            'id_propiedad'
        );
    }

    public function semanas()
    {
        return $this->hasMany(PropiedadSemana::class, 'usuario_id');
    }

    public function gastosComunes()
    {
        return $this->hasMany(GastoComun::class);
    }
    
}
