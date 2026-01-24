<?php

namespace App\Http\Controllers;

use App\Models\PropiedadSemana;
use Illuminate\Support\Facades\Auth;

class CalendarioController extends Controller
{
    public function usuario()
    {
        $usuario = Auth::user();

        $asignaciones = PropiedadSemana::with([
            'semana.anio',
            'propiedad'
        ])->where('usuario_id', $usuario->id)->get();

        $eventos[] = [
            'title' => 'Semana ' . $a->semana->numero_semana,
            'start' => $inicio->toDateString(),
            'end'   => $fin->addDay()->toDateString(),
            'extendedProps' => [
                'usuario' => $a->usuario->name,
                'propiedad' => $a->propiedad->nombre,
                'anio' => $a->semana->anio->anio,
            ]
        ];

        return view('admin.reserved-weeks', compact('eventos'));
    }
}
