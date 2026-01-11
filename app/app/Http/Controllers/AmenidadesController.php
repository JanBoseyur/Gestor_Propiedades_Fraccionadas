<?php

namespace App\Http\Controllers;

use App\Models\Amenidades;

class AmenidadesController extends Controller
{
    # Consulta Tabla Amenidades
    public function show($id)
    {
        $propiedad = Propiedades::with('amenidades')->findOrFail($id);

        return view('PropertySection', compact('propiedad'));
    }
}
