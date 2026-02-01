<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class GastoComun extends Model
{
    protected $table = 'gastos_comunes';

    protected $fillable = [
        'propiedad_id',
        'usuario_id', 
        'anio',
        'mes',
        'semana',
        'monto',
        'estado',
    ];

    public function propiedad()
    {
        return $this->belongsTo(\App\Models\Propiedades::class, 'propiedad_id');
    }

    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }

    public function pagarGasto(GastoComun $gasto, StripeService $stripe)
    {
        $paymentIntent = $stripe->crearPago($gasto->monto, 'clp', "Pago GastoComun #{$gasto->id}");

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret
        ]);
    }

    public function getFechaInicioAttribute()
    {
        return Carbon::now()
            ->setISODate($this->anio, $this->semana)
            ->startOfWeek(Carbon::MONDAY);
    }

    public function getFechaFinAttribute()
    {
        return Carbon::now()
            ->setISODate($this->anio, $this->semana)
            ->startOfWeek(Carbon::MONDAY)
            ->addDays(6);
    }

}
