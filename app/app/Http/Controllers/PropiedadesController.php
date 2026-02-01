<?php

namespace App\Http\Controllers;

use App\Models\Propiedades;
use App\Models\Selection;
use App\Models\User;
use App\Models\PropiedadSemana;
use App\Models\Anio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function listado()
    {
        $propiedades = Propiedades::all();
        return view('admin.manage-properties', compact('propiedades'));
    }
    
    public function show($id)
    {
        $propiedad = Propiedades::findOrFail($id);
        $year = now()->year;

        // Traer todas las selecciones del año actual
        $selections = Selection::where('propiedad_id', $id)
            ->where('anio', $year)
            ->get();

        $events = [];
        $takenWeeks = [];

        foreach ($selections as $sel) {
            $weeks = is_array($sel->semana) ? $sel->semana : json_decode($sel->semana, true);
            if (!$weeks) continue;

            // Si quieres, almacenar las semanas ya ocupadas para bloquear selección
            $takenWeeks = array_merge($takenWeeks, $weeks);

            foreach ($weeks as $week) {
                $range = $this->weekToDateRange($sel->anio, $week);
                $events[] = [
                    'title' => 'No disponible',
                    'start' => $range['start'],
                    'end'   => $range['end'],
                    'display' => 'background',
                    'backgroundColor' => '#EBC999',
                ];
            }
        }

        $takenWeeks = array_unique($takenWeeks);

        return view('property-section', [
            'propiedad'  => $propiedad,
            'events'     => json_encode($events),
            'takenWeeks' => $takenWeeks
        ]);
    }

    public function mostrar_propiedades()
    {
        $propiedades = Propiedades::withCount([
            'selections as n_socios' => function ($query) {
                $query->select(DB::raw('count(distinct id_usuario)'));
            }
        ])->get();

        return view('user.properties', compact('propiedades'));
    }

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

            $inicio = Carbon::create()
                ->setISODate($anio, $numeroSemana)
                ->startOfWeek(Carbon::MONDAY);

            $fin = (clone $inicio)->addDays(6);
            
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

            $inicio = Carbon::create()
                ->setISODate(
                    $a->semana->anio->anio,
                    $a->semana->numero_semana
                )
                ->startOfWeek(Carbon::MONDAY);

            $fin = (clone $inicio)->addDays(6);

            $eventos[] = [
                'title' => $a->propiedad->nombre . ' | ' . $a->usuario->name,
                'start' => $inicio->toDateString(),
                'end'   => $fin->addDay()->toDateString(),
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

    public function calendario_propiedad($id)
    {
        $propiedad = Propiedad::findOrFail($id);

        $selecciones = Selection::where('property_id', $propiedad->id)
            ->where('year', now()->year)
            ->get()
            ->groupBy('partner_id')
            ->map(fn ($rows) => $rows->pluck('week'));

        return view('propiedades.show', [
            'propiedad'   => $propiedad,
            'selecciones' => $selecciones,
        ]);
    }

    private function weekToDateRange(int $year, int $week): array
    {
        $start = Carbon::create()
            ->setISODate($year, $week)
            ->startOfWeek(Carbon::MONDAY);

        $end = (clone $start)->addDays(7);

        return [
            'start' => $start->toDateString(),
            'end'   => $end->addDay()->toDateString(),
        ];
    }

    public function partner()
    {
        return $this->belongsToMany(
            User::class,
            'usuario_propiedad',
            'id_propiedad',
            'id_usuario'
        );
    }

}