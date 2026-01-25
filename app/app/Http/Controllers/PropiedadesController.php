<?php

namespace App\Http\Controllers;

use App\Models\Propiedades;
use App\Models\User;
use App\Models\PropiedadSemana;
use App\Models\Anio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PropiedadesController extends Controller
{
    # Consulta Tabla Propiedades
    public function index()
    {
        $propiedades = Propiedades::all();
        return view('admin.admin-dashboard', compact('propiedades'));
    }

    public function manageProperties()
    {
        $propiedades = Propiedades::all();
        return view('admin.manage-properties', compact('propiedades'));
    }

    # Consulta Tabla Propiedades
    public function listado()
    {
        $propiedades = Propiedades::all();
        return view('admin.manage-properties', compact('propiedades'));
    }
    
    # Consulta Tabla Propiedades por ID
    public function show($id)
    {
        $propiedad = Propiedades::findOrFail($id);
        return view('property-section', compact('propiedad'));
    }

    # Consulta Tabla Propiedades por ID
    public function mostrar_propiedades()
    {
        $propiedades = Propiedades::all();
        return view('user.properties', compact('propiedades'));
    }

    # Consulta Tabla Amenidad Propiedad segun el ID de la consulta de propiedades
    public function show2($id)
    {
        $propiedad = Propiedades::with('amenidades')->findOrFail($id);
        return view('property-section', compact('propiedad'));
    }

    public function show3($id)
    {
        $propiedad = Propiedades::with('amenidades')->findOrFail($id);
        return view('property-section', compact('propiedad'));
    }

    # Consulta Tabla Propiedades
    public function users()
    {
        $users = User::all();
        return view('admin.manage-partners', compact('users'));
    }

    public function socios($id)
    {
        $propiedad = Propiedades::with('usuarios')->findOrFail($id);
        return view('admin.manage-properties', compact('propiedad'));
    }

    public function contar_usuarios_propiedad()
    {
        $propiedades = Propiedades::withCount('usuarios')->get();
        return view('admin.manage-properties', compact('propiedades'));
    }


    public function socios_propiedades()
    {
        $propiedades = Propiedades::with('usuarios')->get();
        return view('admin.manage-properties', compact('propiedades'));
    }

    public function show_semanas($id)
    {
        $propiedad = Propiedades::with([
            'semanas.semana.anio',
            'semanas.usuario'
        ])->findOrFail($id);

        $eventos = [];

        foreach ($propiedad->semanas as $asignacion) {

            $anio = $asignacion->semana->anio->anio;
            $numeroSemana = $asignacion->semana->numero_semana;

            $inicio = Carbon::now()
                ->setISODate($anio, $numeroSemana)
                ->startOfWeek();

            $fin = (clone $inicio)->endOfWeek();

            $eventos[] = [
                'title' => 'Ocupada - ' . $asignacion->usuario->name,
                'start' => $inicio->toDateString(),
                'end'   => $fin->addDay()->toDateString(),
            ];
        }

        return view('admin.reserved-weeks', compact('propiedad', 'eventos'));
    }

    public function calendar_global()
    {
        $asignaciones = PropiedadSemana::with([
            'propiedad',
            'usuario',
            'semana.anio'
        ])->get();

        $eventos = [];

        foreach ($asignaciones as $a) {

            $inicio = Carbon::now()
                ->setISODate(
                    $a->semana->anio->anio,
                    $a->semana->numero_semana
                )
                ->startOfWeek(Carbon::MONDAY);

            $fin = (clone $inicio)->endOfWeek(Carbon::SUNDAY);

            $eventos[] = [
                'title' => $a->propiedad->nombre . ' | ' . $a->usuario->name,
                'start' => $inicio->toDateString(),
                'end'   => $fin->addDay()->toDateString(), // FullCalendar end exclusivo
            ];
        }

        return view('admin.reserved-weeks', compact('eventos'));
    }

    public function reservedWeeks(Request $request)
    {
        $anioFiltro = $request->get('anio');
        $propiedadFiltro = $request->get('propiedad');

        $query = PropiedadSemana::with([
            'propiedad',
            'usuario',
            'semana.anio'
        ]);

        if ($anioFiltro) {
            $query->whereHas('semana.anio', function ($q) use ($anioFiltro) {
                $q->where('anio', $anioFiltro);
            });
        }

        if ($propiedadFiltro) {
            $query->where('propiedad_id', $propiedadFiltro);
        }

        $asignaciones = $query->get();

        $reservas = $asignaciones->groupBy(function ($a) {
            return
                $a->propiedad->id . '-' .
                $a->usuario->id . '-' .
                $a->semana->anio->anio;
        })->map(function ($items) {

            $primero = $items->first();

            return [
                'propiedad' => $primero->propiedad->nombre,
                'usuario'   => $primero->usuario->name,
                'anio'      => $primero->semana->anio->anio,
                'semanas'   => $items->pluck('semana.numero_semana')->sort()->values()
            ];
        });

        return view('admin.reserved-weeks', [
            'reservas'    => $reservas,
            'anios'       => Anio::orderBy('anio', 'desc')->get(),
            'propiedades' => Propiedades::all(),
            'anioFiltro'  => $anioFiltro,
            'propiedadFiltro' => $propiedadFiltro
        ]);
    }

    public function eliminarSocio($propiedadId, $usuarioId)
    {
        $propiedad = Propiedades::findOrFail($propiedadId);
        $propiedad->usuarios()->detach($usuarioId);

        return redirect()->back()->with('success', 'Socio eliminado correctamente.');
    }

}
