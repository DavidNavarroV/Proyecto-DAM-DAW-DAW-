<?php

namespace App\Http\Controllers;

use App\Models\Jugadores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function acceder()
    {
        return view('auth.acceso');
    }

    public function autenticar(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $credentials['activo'] = 1;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin')->withSuccess('Bienvenido al panel de Administración');
        }

        return back()->withErrors([
            'email' => 'El email no está registrado.',
        ]);
    }

    public function registro()
    {
        return view('auth.registro');
    }

    public function registrarse(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:jugadores',
            'password' => 'required|confirmed|min:6',
        ]);

        $data = $request->all();

        $jugador = Jugadores::create([
            'jugador' => $data['nombre'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        Auth::login($jugador);

        return redirect("admin")->withSuccess('Te has registrado correctamente. Bienvenido');
    }

    public function salir(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('admin');
    }
}
