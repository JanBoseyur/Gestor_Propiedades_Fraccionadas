<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Propiedades;
use App\Models\Semana;
use App\Models\PropiedadSemana;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // =====================
        // MÉTRICAS PRINCIPALES
        // =====================

        $totalPropiedades = Propiedades::count();
        $totalSocios = User::where('rol', 'socio')->count();
        $totalSemanas = Semana::count();
        $semanasReservadas = PropiedadSemana::count();
        $semanasDisponibles = $totalSemanas - $semanasReservadas;

        // =====================
        // CÁLCULOS
        // =====================

        $porcentajeOcupacion = $totalSemanas > 0
            ? round(($semanasReservadas / $totalSemanas) * 100)
            : 0;

        $porcentajeDisponible = 100 - $porcentajeOcupacion;

        $promedioSemanasSocio = $totalSocios > 0
            ? round($semanasReservadas / $totalSocios, 1)
            : 0;

        // =====================
        // LISTADO DE PROPIEDADES
        // =====================

        $propiedades = Propiedades::select(
                'id',
                'nombre',
                'imagen1',
                'n_socios',
                'ubicacion'
            )
            ->orderBy('nombre')
            ->get();

        // =====================
        // ENVÍO A LA VISTA
        // =====================

        return view('admin.admin-dashboard', compact(
            'totalPropiedades',
            'totalSocios',
            'totalSemanas',
            'semanasReservadas',
            'semanasDisponibles',
            'porcentajeOcupacion',
            'porcentajeDisponible',
            'promedioSemanasSocio',
            'propiedades'
        ));
    }
}
