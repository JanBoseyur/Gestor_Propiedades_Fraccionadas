<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Selection;
use App\Models\GastoComun;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $anioActual = now()->year;

        /* ===============================
        * GASTOS PAGADOS POR MES
        * =============================== */
        $pagadosPorMes = GastoComun::select(
                'mes',
                DB::raw('SUM(monto) as total')
            )
            ->where('usuario_id', $userId)
            ->where('anio', $anioActual)
            ->where('estado', 'pagado')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        /* ===============================
        * GASTOS PENDIENTES POR MES
        * =============================== */
        $pendientesPorMes = GastoComun::select(
                'mes',
                DB::raw('SUM(monto) as total')
            )
            ->where('usuario_id', $userId)
            ->where('anio', $anioActual)
            ->where('estado', 'pendiente')
            ->groupBy('mes')
            ->pluck('total', 'mes');

        /* ===============================
        * NORMALIZAR MESES
        * =============================== */
        $meses = [
            1 => 'Ene', 2 => 'Feb', 3 => 'Mar', 4 => 'Abr',
            5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Ago',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dic'
        ];

        $labels = [];
        $dataPagado = [];
        $dataPendiente = [];

        foreach ($meses as $numero => $nombre) {
            $labels[] = $nombre;
            $dataPagado[]    = (float) ($pagadosPorMes[$numero] ?? 0);
            $dataPendiente[] = (float) ($pendientesPorMes[$numero] ?? 0);
        }

        /* ===============================
        * TOTAL DE SEMANAS RESERVADAS
        * =============================== */
        $selections = Selection::where('id_usuario', $userId)->get();

        $totalSemanas = $selections->sum(function ($sel) {
            $weeks = is_array($sel->semana)
                ? $sel->semana
                : json_decode($sel->semana, true);

            return is_array($weeks) ? count($weeks) : 0;
        });

        /* ===============================
        * PROPIEDADES DONDE ES SOCIO
        * =============================== */
        $totalPropiedades = Selection::where('id_usuario', $userId)
            ->distinct('propiedad_id')
            ->count('propiedad_id');

        /* ===============================
        * PAGOS PENDIENTES
        * =============================== */
        $pagosPendientes = GastoComun::where('usuario_id', $userId)
            ->where('estado', 'pendiente')
            ->count();

        /* ===============================
        * PAGOS PAGADOS
        * =============================== */
        $pagosPagados = GastoComun::where('usuario_id', $userId)
            ->where('estado', 'pagado')
            ->count();

        return view('user.user-dashboard', compact(
            'labels',
            'dataPagado',
            'dataPendiente',
            'totalSemanas',
            'totalPropiedades',
            'pagosPendientes',
            'pagosPagados'
        ));
    }

}
