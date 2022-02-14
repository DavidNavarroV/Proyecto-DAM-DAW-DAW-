<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
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
        //$credentials['password'] = "1234Abcd!";

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin')->withSuccess('Bienvenido al panel de Administración');
        }

        return back()->withErrors([
            'email' => 'El email  no está registrado.',
        ])->withWarning('eeror');

    }

    public function registro()
    {
        return view('auth.registro');
    }

    public function registrarse(Request $request)
    {
        $request->validate([
            'jugador' => 'required',
            'email' => 'required|email |unique:jugadores',
            'password' => 'required|confirmed|min:6',
        ]);

        $data = $request->all();

        $jugador = Jugador::create([
            'jugadores' => $data['jugadores'],
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
