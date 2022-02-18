<?php

namespace App\Http\Controllers;

use App\Models\Partida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Jugadores;
use App\Http\Requests\JugadorRequest;

class JugadorController extends Controller
{
    public function __construct()
    {
        /**
         * Asigno el middleware auth al controlador,
         * de modo que sea necesario estar al menos autenticado
         */
        $this->middleware('auth');
    }

    /**
     * Mostrar un listado de elementos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtengo todos los usuarios ordenados por nombre
        $rowset = Jugadores::orderBy("jugador","ASC")->get();

        /*return view('admin.usuarios.index',[
            'rowset' => $rowset,
        ]);*/
    }

    /**
     * Mostrar el formulario para crear un nuevo elemento
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        //Creo un nuevo usuario vacío
        $row = new Jugadores();

        return view('admin.jugadores.editar',[
            'row' => $row,
        ]);
    }

    /**
     * Guardar un nuevo elemento en la bbdd
     *
     * @param  \App\Http\Requests\JugadorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(JugadorRequest $request)
    {
        Jugadores::create([
            'jugador' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jugadores' => ($request->jugadores) ? 1 : 0,
            'partidas' => ($request->partidas) ? 1 : 0,
        ]);

        return redirect('admin/jugadores')->with('success', 'jugador <strong>'.$request->nombre.'</strong> creado');
    }

    /**
     * Mostrar el formulario para editar un elemento
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        //Obtengo el usuario o muestro error
        $row = Jugadores::where('id', $id)->firstOrFail();

        /*return view('admin.jugadores.editar',[
            'row' => $row,
        ]);*/
    }

    /**
     * Actualizar un elemento en la bbdd
     *
     * @param  \App\Http\Requests\JugadorRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(JugadorRequest $request, $id)
    {
        $row = Jugadores::findOrFail($id);

        Jugadores::where('id', $row->id)->update([
            'jugador' => $request->nombre,
            'email' => $request->email,
            'password' => ($request->cambiar_clave) ? Hash::make($request->password) : $row->password,
            'jugadores' => ($request->jugadores) ? 1 : 0,
            'partidas' => ($request->partidas) ? 1 : 0,
        ]);

        return redirect('admin/jugadores')->with('success', 'Jugador <strong>'.$request->nombre.'</strong> guardado');
    }

    /**
     * Activar o desactivar elemento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activar($id)
    {
        $row = Juguadores::findOrFail($id);
        $valor = ($row->activo) ? 0 : 1;
        $texto = ($row->activo) ? "desactivado" : "activado";

        Jugadores::where('id', $row->id)->update(['activo' => $valor]);

        return redirect('admin/jugadores')->with('success', 'Jugador <strong>'.$row->name.'</strong> '.$texto.'.');
    }

    /**
     * Borrar elemento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function borrar($id)
    {
        $row = Jugadores::findOrFail($id);

        Jugadores::destroy($row->id);

        return redirect('admin/jugadores')->with('success', 'Jugador <strong>'.$row->nombre.'</strong> borrado');
    }
    /**
     * Ver estadisticas 1j.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Estadistica -> 1j
    public function estadisticas($id)
    {
        //Obtengo el usuario y muestro la estadistica
        $row = Partida::where('jugador', $id)->limit(5);
        echo ($row-> jugador);
        echo ($row-> puntos . " puntos");
        echo ($row-> tiempo . "?");
    }


}
