<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function show($id) {
        $property = Property::findOrFail($id);
        return response()->json($property);
    }
}
