<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefuncioneController extends Controller
{
    //

    public function registrarDefuncion($valor){

        return response()->json('{caca1:"valor"}');
    }

    public function obtenerDefuncion($cui){
        $person = DB::table('DEFUNCION')
        ->select('*')
        ->where('cui','=',$cui)
        ->get();
    }

    public function imprimirDefuncion($valor){

        $objeto = new DefuncioneController;
        $json_recibido = json_decode($valor,true);

        $valor_cui = $json_recibido['cui'];

        $defuncion_obtenida = $objeto->obtenerDefuncion($valor_cui);

        if($defuncion_obtenida == "[]"){
            
            $json_response =
            [
                'status' => 0,
                'mensaje' => "Registro de defucion con el DPI no encontrado",
                'data' => [],
            ];

            return response()->json($resultado_final);
        }else{

            $json_response =
            [
                'status' => 1,
                'mensaje' => "DPI encontrado",
                'data' => [$defuncion_obtenida],
            ];
            
            return response()->json($resultado_final);
        }

    }


}
