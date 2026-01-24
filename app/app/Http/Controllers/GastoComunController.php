<?php

namespace App\Http\Controllers;

use App\Models\GastoComun;
use App\Models\Propiedades;
use Illuminate\Http\Request;

class GastoComunController extends Controller
{
    public function index(Request $request)
    {
        $anio = $request->anio ?? now()->year;
        $mes  = $request->mes  ?? now()->month;

        $pagos = GastoComun::with(['propiedad','usuario'])
            ->when($request->propiedad_id, fn($q) =>
                $q->where('propiedad_id', $request->propiedad_id)
            )
            ->when($request->estado, fn($q) =>
                $q->where('estado', $request->estado)
            )
            ->where('anio', $anio)
            ->where('mes', $mes)
            ->orderBy('propiedad_id')
            ->get();

        $propiedades = Propiedades::orderBy('nombre')->get();

        return view('admin.billing-page', compact(
            'pagos',
            'propiedades',
            'anio',
            'mes'
        ));
    }

    public function generar(Request $request)
    {
        $request->validate([
            'anio' => 'required|integer',
            'mes'  => 'required|integer|min:1|max:12',
        ]);

        $creados = 0;

        $propiedades = Propiedades::with('socios')->get();

        foreach ($propiedades as $propiedad) {
            foreach ($propiedad->socios as $socio) {

                $existe = GastoComun::where([
                    'propiedad_id' => $propiedad->id,
                    'user_id' => $socio->id,
                    'anio' => $request->anio,
                    'mes' => $request->mes,
                ])->exists();

                if (!$existe) {
                    GastoComun::create([
                        'propiedad_id' => $propiedad->id,
                        'user_id' => $socio->id,
                        'anio' => $request->anio,
                        'mes' => $request->mes,
                        'monto' => $propiedad->gasto_comun,
                        'estado' => 'pendiente',
                    ]);
                    $creados++;
                }
            }
        }

        return back()->with('success', "$creados gastos creados");
    }

    public function marcarPagado(GastoComun $gasto)
    {
        $gasto->update([
            'estado' => 'pagado'
        ]);

        return back()->with('success', 'Pago marcado como pagado');
    }
}

