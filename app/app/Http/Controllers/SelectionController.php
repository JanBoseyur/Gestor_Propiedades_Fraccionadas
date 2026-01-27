<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Selection;
use App\Models\GastoComun;

class SelectionController extends Controller
{
    // Guardar selección de semanas
    public function save(Request $request, $propiedad)
    {
        // Debug
        \Log::info('Request recibido', $request->all());

        $data = $request->validate([
            'semana' => 'required|array|min:1',
            'anio'   => 'required|integer',
        ]);

        $userId = auth()->id();
        $year = $request->anio;
        $semanas = $request->semana;

        // Traemos selección existente
        $existing = Selection::where('propiedad_id', $propiedad)
            ->where('id_usuario', $userId)
            ->where('anio', $year)
            ->first();

        $oldWeeks = $existing ? json_decode($existing->semana, true) : [];
        $allWeeks = array_unique(array_merge($oldWeeks, $semanas));

        // Guardamos la selección
        if ($existing) {
            $existing->semana = json_encode($allWeeks);
            $existing->save();
            $selection = $existing;
        } else {
            $selection = Selection::create([
                'propiedad_id' => $propiedad,
                'id_usuario' => $userId,
                'anio' => $year,
                'semana' => json_encode($allWeeks),
            ]);
        }

        // Creamos gastos comunes para las semanas nuevas
        foreach ($semanas as $week) {
            $startOfWeek = \Carbon\Carbon::now()->setISODate($year, $week)->startOfWeek();
            $mes = $startOfWeek->month;

            $existsGasto = GastoComun::where([
                'propiedad_id' => $propiedad,
                'anio' => $year,
                'mes' => $mes,
                'semana' => $week,        // ✅ usar $week
                'usuario_id' => $userId,
            ])->first();

            if (!$existsGasto) {
                // DEBUG: mostrar valores
                \Log::info('Creando GastoComun', [
                    'propiedad_id' => $propiedad,
                    'anio' => $year,
                    'mes' => $mes,
                    'usuario_id' => $userId,
                    'monto' => 250,
                    'semana' => $week        // ✅ usar $week
                ]);

                GastoComun::create([
                    'propiedad_id' => $propiedad,
                    'anio' => $year,
                    'mes' => $mes,
                    'usuario_id' => $userId,
                    'monto' => 250,
                    'semana' => $week,       // ✅ usar $week
                    'estado' => 'pendiente',
                    'fecha_pago' => null,
                ]);
            }
        }

        return response()->json([
            'message' => '¡Selecciones y gastos guardados correctamente!',
            'selection' => $selection
        ]);
    }

}
