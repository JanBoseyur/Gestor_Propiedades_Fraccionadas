<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Mostrar formulario con datos del usuario logueado
    public function edit()
    {
        $user = Auth::user(); // Usuario logueado
        return view('profile.edit', compact('user'));
    }

    // Guardar cambios
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:255',
            'city'    => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'phone'   => 'nullable|string|max:20',
        ]);

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'address' => $request->address,
            'city'    => $request->city,
            'country' => $request->country,
            'phone'   => $request->phone,
        ]);

        return redirect()->back()->with('success', '¡Tu perfil ha sido actualizado con éxito!');
    }
}

