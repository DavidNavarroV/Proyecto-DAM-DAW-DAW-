<?php

namespace App\Http\Controllers;

use App\Models\Partida;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Ver estadisticas top.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Estadistica -> 1j
    public function top(Request $request)
    {
        $pagina = ($request ->pagina);
        //Obtengo el usuario y muestro la estadistica
        $row = Partida::orderBy('puntos', "DESC")->paginate(10,['*'],'pagina', $pagina);

        return view('admin.index',[
            'row' => $row,
        ]);
    }
}
