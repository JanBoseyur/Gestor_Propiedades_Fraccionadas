<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Selection;
use App\Models\GastoComun;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

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
            'totalSemanas',
            'totalPropiedades',
            'pagosPendientes',
            'pagosPagados'
        ));
    }
}
