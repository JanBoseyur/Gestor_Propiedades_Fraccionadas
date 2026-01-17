<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Propiedades;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPropiedades = Propiedades::count();
        $propiedades = Propiedades::all(); 

        return view('admin.admin-dashboard', compact(
            'totalPropiedades',
            'propiedades'
        ));
    }
}