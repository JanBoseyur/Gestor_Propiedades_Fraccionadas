<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.admin-dashboard');
            
            } elseif ($user->hasRole('user')) {
                return redirect()->route('user.dashboard');
            }

            return redirect('/login')->withErrors(['role' => 'Rol no asignado']);
        }

        return back()->withErrors([
            'email' => 'Correo o contraseña incorrectos',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('user');

        Auth::login($user);

        return redirect('/login');
    }
}
