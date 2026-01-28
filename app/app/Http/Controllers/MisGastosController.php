<?php

namespace App\Http\Controllers;

use App\Models\GastoComun;
use App\Models\Propiedades;
use Illuminate\Http\Request;

class MisGastosController extends Controller
{
    public function index(Request $request)
    {
    $pagos = GastoComun::with(['propiedad', 'usuario'])

        ->when($request->filled('anio'), fn ($q) =>
            $q->where('anio', $request->anio)
        )

        ->when($request->filled('mes'), fn ($q) =>
            $q->where('mes', $request->mes)
        )

        ->when($request->filled('propiedad_id'), fn ($q) =>
            $q->where('propiedad_id', $request->propiedad_id)
        )

        ->when($request->filled('estado'), fn ($q) =>
            $q->where('estado', $request->estado)
        )

        ->orderBy('anio', 'desc')
        ->orderBy('mes')
        ->orderBy('propiedad_id')
        ->get();

    $propiedades = Propiedades::orderBy('nombre')->get();

    return view('user.user-billing-page', [
        'pagos' => $pagos,
        'propiedades' => $propiedades,
    ]);
    }
}
