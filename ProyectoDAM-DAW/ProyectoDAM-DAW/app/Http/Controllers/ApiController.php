<?php

namespace App\Http\Controllers;

use App\Models\Partida;

class ApiController extends Controller
{
    public function mostrar()
    {

        //Obtengo las noticias a mostrar en el listado de noticias
        $rowset = Partida::orderBy('fecha', 'DESC')->get();

        //Opción rápida (datos completos)
        //$noticias = $rowset;

        //Opción personalizada
        foreach ($rowset as $row) {
            $partida[] = [
                'id' => $row->id,
                'jugador' => $row->jugador,
                'puntos' => $row->puntos,
                'tiempo' => $row->tiempo,
                'fecha' => date("d/m/Y", strtotime($row->fecha)),
                'created_at' => date("d/m/Y", strtotime($row->created_at)),
            ];
        }
        //Devuelvo JSON
        return response()->json(
            $partida, //Array de objetos
            200, //Tipo de respuesta
            [], //Headers
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE //Opciones de escape
        );
    }

    public function leer(){

        //Url de destino
        $url = route('mostrar');

        //Parseo datos a un array
        $rowset = json_decode(file_get_contents($url), true);

        //LLamo a la vista
        return view('api.leer',[
            'rowset' => $rowset,
        ]);

    }

public function escribir($jugador,$puntos,$fecha,$tiempo){

        Partida::insert(
            [
                'jugador' => $jugador,
                'puntos' => $puntos,
                'fecha' => \DateTime::createFromFormat("d-m-Y", $fecha)->format("Y-m-d H:i:s"),
                'tiempo' => $tiempo,

            ]
        );
    }
}
