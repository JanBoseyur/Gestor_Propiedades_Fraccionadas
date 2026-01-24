<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function isAdmin()
    {
        return $this->role === 'admin';
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

    public function propiedadesAsignadas()
    {
        return $this->hasMany(PropiedadSemana::class, 'usuario_id');
    }

    public function semanasAsignadas()
    {
        return $this->hasMany(PropiedadSemana::class, 'usuario_id');
    }

    public function gastosComunes()
    {
        return $this->hasMany(GastoComun::class);
    }
    
}