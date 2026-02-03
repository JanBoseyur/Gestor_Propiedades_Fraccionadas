<?php

namespace App\Http\Controllers;

use App\Models\Propiedades;
use App\Models\GastoComun;
use App\Models\Selection;

class AdminController extends Controller
{
    public function index()
    {
        $propiedades = Propiedades::all();

        // Por ejemplo, si quieres estadísticas de gastos
        $gastos = GastoComun::selectRaw("estado, COUNT(*) as total")
                    ->groupBy('estado')
                    ->pluck('total', 'estado');

        return view('admin.admin-dashboard', compact('propiedades', 'gastos'));
    }
}
