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

        $pagos = GastoComun::with(['propiedad','usuario'])
            ->where('anio', $anio)
            ->when($request->mes, fn($q) =>
                $q->where('mes', $request->mes)
            )
            ->when($request->propiedad_id, fn($q) =>
                $q->where('propiedad_id', $request->propiedad_id)
            )
            ->when($request->estado, fn($q) =>
                $q->where('estado', $request->estado)
            )
            ->orderBy('mes')
            ->orderBy('propiedad_id')
            ->get();

        $propiedades = Propiedades::orderBy('nombre')->get();

        return view('admin.billing-page', compact(
            'pagos',
            'propiedades',
            'anio',
        ));
    }

    public function generar(Request $request)
    {
        $request->validate([
            'anio' => 'required|integer',
            'mes'  => 'required|integer|min:1|max:12',
        ]);

        $creados = 0;

        $propiedades = Propiedades::with(['usuarios', 'selections'])->get();

        foreach ($propiedades as $propiedad) {
            foreach ($propiedad->usuarios as $socio) {

                $semanas = $socio->selections()
                    ->where('propiedad_id', $propiedad->id)
                    ->where('anio', $request->anio)
                    ->pluck('semana'); 

                foreach ($semanas as $semana) {

                    $startOfWeek = \Carbon\Carbon::now()->setISODate($request->anio, $semana)->startOfWeek();
                    $mesReal = $startOfWeek->month;

                    $existe = GastoComun::where([
                        'propiedad_id' => $propiedad->id,
                        'usuario_id' => $socio->id,
                        'anio' => $request->anio,
                        'mes' => $mesReal,
                        'semana' => $semana
                    ])->exists();

                    if (!$existe) {
                        GastoComun::create([
                            'propiedad_id' => $propiedad->id,
                            'usuario_id' => $socio->id,
                            'anio' => $request->anio,
                            'mes' => $mesReal,
                            'semana' => $semana,
                            'monto' => $propiedad->gasto_comun,
                            'estado' => 'pendiente',
                        ]);
                        $creados++;
                    }
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

