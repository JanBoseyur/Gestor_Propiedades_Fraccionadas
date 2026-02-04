<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GastoComun;

class ChartController extends Controller
{
    public function index()
    {
        $gastos = GastoComun::selectRaw("estado, COUNT(*) as total")
            ->groupBy('estado')
            ->pluck('total', 'estado')
            ->mapWithKeys(fn ($total, $estado) => [
                ucfirst($estado) => $total
            ]);

        $reservasPorMes = GastoComun::selectRaw('mes, COUNT(*) as total')
            ->where('anio', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        $recaudadoPorMesRaw = GastoComun::selectRaw('mes, SUM(monto) as total')
            ->where('anio', now()->year)
            ->where('estado', 'pagado')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        $recaudadoPorMes = collect(range(1, 12))->mapWithKeys(function ($mes) use ($recaudadoPorMesRaw) {
            return [$mes => (int) ($recaudadoPorMesRaw[$mes] ?? 0)];
        });
        
        return response()->json([
            'gastos' => $gastos,
            'reservasPorMes' => $reservasPorMes,
            'recaudadoPorMes' => $recaudadoPorMes,
        ]);
    }
}
