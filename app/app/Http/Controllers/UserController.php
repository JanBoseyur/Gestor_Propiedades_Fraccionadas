<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Selection;

class UserController extends Controller
{
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return back()->with('success', 'Usuario actualizado');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'Usuario eliminado');
    }

    public function misSemanas()
    {
        $selections = Selection::with('propiedad')
            ->where('id_usuario', auth()->id())
            ->orderBy('anio', 'desc')
            ->get();
        
        return view('user.semanas', compact('selections'));
    }
}
