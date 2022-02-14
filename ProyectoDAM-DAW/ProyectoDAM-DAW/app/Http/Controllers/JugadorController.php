<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Jugador;
use App\Http\Requests\JugadorRequest;

class JugadorController extends Controller
{
    public function __construct()
    {
        /**
         * Asigno el middleware auth al controlador,
         * de modo que sea necesario estar al menos autenticado
         */
        $this->middleware('auth');//mira si está logueado
    }

    /**
     * Mostrar un listado de elementos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtengo todos los usuarios ordenados por jugador
        $rowset = Jugador::orderBy("jugador","ASC")->get();

        return view('admin.jugador.index',[
            'rowset' => $rowset,
        ]);
    }

    /**
     * Mostrar el formulario para crear un nuevo elemento
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        //Creo un nuevo usuario vacío
        $row = new Jugador();

        return view('admin.jugador.editar',[
            'row' => $row,
        ]);
    }

    /**
     * Guardar un nuevo elemento en la bbdd
     *
     * @param  \App\Http\Requests\UsuarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(UsuarioRequest $request)
    {
        Jugador::create([
            'jugador' => $request->jugador,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jugadores' => ($request->jugadores) ? 1 : 0,
            //'noticias' => ($request->noticias) ? 1 : 0,
        ]);

        return redirect('admin/jugadores')->with('success', 'Usuario <strong>'.$request->jugador.'</strong> creado');
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
        $row = Jugador::where('id', $id)->firstOrFail();//en el caso de tener dos id saca el primero

        return view('admin.jugadores.editar',[
            'row' => $row,
        ]);
    }

    /**
     * Actualizar un elemento en la bbdd
     *
     * @param  \App\Http\Requests\UsuarioRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(UsuarioRequest $request, $jugador)
    {
        $row = Jugador::firstOrFail($jugador);

        Jugador::where('id', $row->id)->get(); ([
            'jugador' => $request->jugador,
            'email' => $request->email,
            'password' => ($request->cambiar_clave) ? Hash::make($request->password) : $row->password,

        ]);

    }

    /**
     * Activar o desactivar elemento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activar($id)
    {
        $row = Jugador::findOrFail($id);//encuentra el id o falle
        $valor = ($row->activo) ? 0 : 1;
        $texto = ($row->activo) ? "desactivado" : "activado";

        Jugador::where('id', $row->id)->update(['activo' => $valor]);

        return redirect('admin/jugadores')->with('success', 'Usuario <strong>'.$row->name.'</strong> '.$texto.'.');
    }

    /**
     * Borrar elemento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function borrar($id)
    {
        $row = Jugador::findOrFail($id);

        Jugador::destroy($row->id);

        return redirect('admin/jugadores')->with('success', 'Usuario <strong>'.$row->jugador.'</strong> borrado');
    }
}
