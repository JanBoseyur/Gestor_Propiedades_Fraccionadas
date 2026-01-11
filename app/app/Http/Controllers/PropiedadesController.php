<?php

namespace App\Http\Controllers;

use App\Models\Propiedades;

class PropiedadesController extends Controller
{
    # Consulta Tabla Propiedades
    public function index()
    {
        $propiedades = Propiedades::all();
        return view('admin.AdminDashboard', compact('propiedades'));
    }

    # Consulta Tabla Propiedades por ID
    public function show($id)
    {
        $propiedad = Propiedades::findOrFail($id);
        return view('PropertySection', compact('propiedad'));
    }
}
