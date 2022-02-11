<?php

namespace App\Http\Controllers;

class ApiControler extends Controller
{
    public function mostrar()
    {

        //Obtengo las noticias a mostrar en el listado de noticias
        $rowset = Noticia::where('activo', 1)->orderBy('fecha', 'DESC')->get();

        //Opción rápida (datos completos)
        //$noticias = $rowset;

        //Opción personalizada
        foreach ($rowset as $row) {
            $noticias[] = [
                'titulo' => $row->titulo,
                'entradilla' => $row->entradilla,
                'autor' => $row->autor,
                'fecha' => date("d/m/Y", strtotime($row->fecha)),
                'enlace' => url("noticia/" . $row->slug),
                'imagen' => asset("img/" . $row->imagen)
            ];
        }
        //Devuelvo JSON
        return response()->json(
            $noticias, //Array de objetos
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

    public function escribir($id){
        //Url de destino
        $url = route('mostrar');

        $data = file_get_contents($url);
        $items = json_decode($data, true);

        Noticia::insert(
            [
                'titulo' => $items[$id]["titulo"],
                'entradilla' => $items[$id]["entradilla"],
                'fecha' => \DateTime::createFromFormat("d/m/Y", $items[$id]["fecha"])->format("Y-m-d H:i:s"),
                'autor' => $items[$id]["autor"],

            ]
        );
    }
}
