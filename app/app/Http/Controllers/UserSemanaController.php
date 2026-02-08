<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Selection;
use App\Models\Propiedades;
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
            $allWeeks = is_array($seleccion->semana)
                ? $seleccion->semana
                : json_decode($seleccion->semana, true);

            $allWeeks = array_map('intval', $allWeeks);

            $semanasFechas = [];

            foreach ($allWeeks as $numeroSemana) {
                $inicio = Carbon::now()
                    ->setISODate($seleccion->anio, $numeroSemana)
                    ->locale('es')
                    ->startOfWeek()
                    ->translatedFormat('d \d\e F');

                $fin = Carbon::now()
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

        $estanciasCercanas = $this->estanciasMasCercanas();

        return view('user.semanas', compact('selecciones', 'estanciasCercanas'));

    }

    private function estanciasMasCercanas()
    {
        $userId = auth()->id();

        $estancias = Selection::with('propiedad')
            ->where('id_usuario', $userId)
            ->get();

        if ($estancias->isEmpty()) return collect();

        // Calcula el número de semana más pequeña inscrita en el futuro
        $minSemana = $estancias->map(fn($e) => collect(json_decode($e->semana))->min())->min();

        $estanciasCercanas = $estancias->filter(function($e) use ($minSemana) {
            return in_array($minSemana, json_decode($e->semana));
        })->map(function($e) use ($minSemana) {
            $inicio = Carbon::now()->setISODate($e->anio, $minSemana)->startOfWeek();
            $fin = (clone $inicio)->endOfWeek();

            $e->fecha_inicio = $inicio;
            $e->fecha_fin = $fin;
            $e->rango_formateado = ucfirst($inicio->locale('es')->translatedFormat('d \d\e F'))
                                . ' al ' .
                                ucfirst($fin->locale('es')->translatedFormat('d \d\e F \d\e Y'));
            return $e;
        });

        return $estanciasCercanas;
    }

}
