<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Selection;
use Carbon\Carbon;

class UserSemanaController extends Controller
{
    public function index()
    {
        Carbon::setLocale('es'); 

    $selecciones = Selection::with('propiedad')
        ->where('id_usuario', auth()->id())
        ->orderBy('anio', 'desc')
        ->get();

    foreach ($selecciones as $seleccion) {
        $allWeeks = is_array($seleccion->semana) ? $seleccion->semana : json_decode($seleccion->semana, true);
        $allWeeks = array_map('intval', $allWeeks);

        $semanasFechas = [];
        foreach ($allWeeks as $numeroSemana) {
            $inicio = \Carbon\Carbon::now()
                ->setISODate($seleccion->anio, $numeroSemana)
                ->locale('es')
                ->startOfWeek()
                ->translatedFormat('d \d\e F');

            $fin = \Carbon\Carbon::now()
                ->setISODate($seleccion->anio, $numeroSemana)
                ->locale('es')
                ->endOfWeek()
                ->translatedFormat('d \d\e F');

            $semanasFechas[] = [
                'numero' => $numeroSemana,
                'inicio' => $inicio,
                'fin' => $fin,
            ];
        }

        $seleccion->semanasFechas = $semanasFechas;
    }

    return view('user.semanas', compact('selecciones'));
    }
}
