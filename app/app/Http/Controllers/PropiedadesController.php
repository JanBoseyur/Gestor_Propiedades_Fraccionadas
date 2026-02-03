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
        $propiedades = Propiedades::with('socios')->get();

        $propiedades = $propiedades->map(function ($prop) {
            return [
                'propiedad' => $prop,
                'socios'    => $prop->socios, 
                'partners'  => $prop->socios->count(),
                'title'     => $prop->nombre,
                'location'  => $prop->ubicacion,
                'background'=> $prop->primeraFoto ?? asset('images/default-property.jpg')
            ];
        });

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

        // Traemos todas las selecciones con la propiedad y el usuario
        $query = Selection::with(['propiedad', 'usuario'])
            ->orderBy('anio', 'desc');

        if ($anioFiltro) {
            $query->where('anio', $anioFiltro);
        }

        if ($propiedadFiltro) {
            $query->where('propiedad_id', $propiedadFiltro);
        }

        $selecciones = $query->get();

        // Agrupar por propiedad, usuario y año
        $reservas = $selecciones->groupBy(function ($item) {
            return $item->propiedad_id . '-' . $item->id_usuario . '-' . $item->anio;
        })->map(function ($items) {
            $primero = $items->first();

            // Unir todas las semanas de ese usuario en esa propiedad y año
            $semanas = [];
            foreach ($items as $s) {
                $ws = is_array($s->semana) ? $s->semana : json_decode($s->semana, true);
                if ($ws) $semanas = array_merge($semanas, $ws);
            }

            $semanas = array_unique($semanas);
            sort($semanas);

            return [
                'propiedad' => $primero->propiedad->nombre,
                'usuario'   => $primero->usuario->name,
                'anio'      => $primero->anio,
                'semanas'   => $semanas,
            ];
        })->values(); // Reset keys

        // Traemos filtros para el formulario
        $anios = Selection::select('anio')->distinct()->orderBy('anio', 'desc')->get();
        $propiedades = \App\Models\Propiedades::all();

        return view('admin.reserved-weeks', [
            'reservas'       => $reservas,
            'anios'          => $anios,
            'propiedades'    => $propiedades,
            'anioFiltro'     => $anioFiltro,
            'propiedadFiltro'=> $propiedadFiltro
        ]);
    }

    public function eliminarSocio($propiedadId, $usuarioId)
    {
        Selection::where('id_usuario', $usuarioId)->delete();

        $propiedad = Propiedades::findOrFail($propiedadId);
        $propiedad->usuarios()->detach($usuarioId);

        return redirect()->back()->with('success', 'Socio y sus semanas eliminadas correctamente.');
    }

    public function calendario_propiedad($id)
    {
        $propiedad = Propiedades::findOrFail($id);

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

    public function semanasDisponibles($id, Request $request)
    {
        $anio = $request->get('anio', now()->year);

        // 1. Traer selecciones del año
        $selections = Selection::where('propiedad_id', $id)
            ->where('anio', $anio)
            ->get();

        // 2. Unir semanas ocupadas
        $semanasOcupadas = [];

        foreach ($selections as $sel) {
            if (is_array($sel->semana)) {
                $semanasOcupadas = array_merge($semanasOcupadas, $sel->semana);
            }
        }

        $semanasOcupadas = array_unique($semanasOcupadas);

        // 3. Todas las semanas del año
        $todasLasSemanas = range(1, 52);

        // 4. Calcular disponibles
        $semanasDisponibles = array_values(
            array_diff($todasLasSemanas, $semanasOcupadas)
        );

        return response()->json([
            'anio'        => $anio,
            'ocupadas'    => $semanasOcupadas,
            'disponibles' => $semanasDisponibles,
        ]);
    }

    public function semanasDetalle($id, Request $request)
    {
        $anio = $request->get('anio', now()->year);

        // Selecciones ocupadas
        $selections = Selection::where('propiedad_id', $id)
            ->where('anio', $anio)
            ->get();

        $ocupadas = [];

        foreach ($selections as $s) {
            $semanas = is_array($s->semana)
                ? $s->semana
                : json_decode($s->semana, true);

            if ($semanas) {
                $ocupadas = array_merge($ocupadas, $semanas);
            }
        }

        $ocupadas = array_unique($ocupadas);

        $resultado = [];

        foreach (range(1, 52) as $numSemana) {

            $inicio = Carbon::now()
                ->setISODate($anio, $numSemana)
                ->startOfWeek(Carbon::MONDAY);

            $fin = (clone $inicio)->endOfWeek(Carbon::SUNDAY);

            $resultado[] = [
                'semana_id' => $numSemana,
                'inicio'    => $inicio->toDateString(),
                'fin'       => $fin->toDateString(),
                'estado'    => in_array($numSemana, $ocupadas)
                    ? 'ocupada'
                    : 'disponible',
            ];
        }

        return response()->json([
            'anio'    => $anio,
            'semanas' => $resultado
        ]);
    }

    public function edit(Propiedades $propiedad)
    {
        return view('admin.edit-property', compact('propiedad'));
    }

    public function update(Request $request, Propiedades $propiedad)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'ubicacion' => 'required|string|max:100',
            'descripcion' => 'required|string|max:200',
            'fotos.*' => 'image|mimes:jpg,jpeg,png,gif,webp',
            'amenidades' => 'nullable|string',
        ]);

        $data = $request->only(['nombre', 'ubicacion', 'descripcion']);

        // Amenidades
        $data['amenidades'] = $request->amenidades ? json_encode(array_map('trim', explode(',', $request->amenidades))) : null;

        // Fotos
        if ($request->hasFile('fotos')) {
            $fotos = [];
            foreach ($request->file('fotos') as $file) {
                $path = $file->store('propiedades', 'public');
                $fotos[] = asset('storage/' . $path);
            }
            $data['fotos'] = json_encode($fotos);
        }

        $propiedad->update($data);

        return redirect()->route('admin.manage-properties')->with('success', 'Propiedad actualizada.');
    }

}