<?php

namespace App\Http\Controllers;

use App\Models\Propiedades;

class PropiedadesController extends Controller
{
    # Consulta Tabla Propiedades
    public function index()
    {
        $propiedades = Propiedades::all();
        return view('admin.admin-dashboard', compact('propiedades'));
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
}
