<?php

namespace App\Http\Controllers;

use App\Models\Propiedades;
use App\Models\GastoComun;
use App\Models\Selection;

class AdminController extends Controller
{
    public function index()
    {
        // ================== GASTOS ==================
        $gastos = GastoComun::selectRaw("estado, COUNT(*) as total")
            ->groupBy('estado')
            ->pluck('total', 'estado')
            ->mapWithKeys(fn ($total, $estado) => [
                ucfirst($estado) => $total
            ]);

        // ================== RESERVAS POR MES ==================
        $reservasPorMes = GastoComun::selectRaw('mes, COUNT(*) as total')
            ->where('anio', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        // ================== RECAUDADO POR MES ==================
        $recaudadoPorMesRaw = GastoComun::selectRaw('mes, SUM(monto) as total')
            ->where('anio', now()->year)
            ->where('estado', 'pagado')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        $recaudadoPorMes = collect(range(1, 12))->mapWithKeys(function ($mes) use ($recaudadoPorMesRaw) {
            return [$mes => (int) ($recaudadoPorMesRaw[$mes] ?? 0)];
        });

        // ================== TARJETAS ==================
        $totalReservas = GastoComun::count();
        $totalRecaudado = GastoComun::where('estado', 'pagado')->sum('monto');
        $totalPendientes = GastoComun::where('estado', 'pendiente')->count();
        $porcentajePendientes = $totalReservas > 0
            ? round(($totalPendientes / $totalReservas) * 100, 1)
            : 0;
        $totalPropiedades = Propiedades::count();

        // ================== RETORNAR A LA VISTA ==================
        return view('admin.admin-dashboard', compact(
            'gastos',
            'reservasPorMes',
            'recaudadoPorMes',
            'totalReservas',
            'totalRecaudado',
            'totalPendientes',
            'porcentajePendientes',
            'totalPropiedades'
        ));
    }
}
