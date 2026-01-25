<?php

namespace App\Http\Controllers;

use App\Models\Propiedades;

class AdminController extends Controller
{
    public function index()
    {
        $totalPropiedades = Propiedades::count();
        $propiedades = Propiedades::all(); 

        return view('admin.admin-dashboard', [
            'totalPropiedades' => $totalPropiedades,
            'propiedades' => $propiedades,
        ]);
    }
}
