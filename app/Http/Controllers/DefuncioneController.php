<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DefuncioneController extends Controller
{
    //

    public function ingresarDefuncion(){
        //
    }

    public function store(Request $request){
        
        error_log(json_encode($request));
        
        $objeto = new DefuncioneController;

            $json_response = [
                'cui' => $request['cui'],
                'cuiCompareciente' => $request['cuiCompareciente'],
                'genero' => $request['genero'],
                'lugarDeDefuncion' => $request['lugarDeDefuncion'],
                'municipio' => $request['municipio'],
                'fechaDeDefuncion' => $request['fechaDeDefuncion'],
                'causa' => $request['causa']
            ];
            $objeto->registrarDefuncion(json_encode($json_response));
            if($mensaje["status"]==-1){
                Session::flash('alert','No se pudo ingresar el matrimonio');
                return Redirect::to('defuncion/create')->with('message','fail');
            }else{
                Session::flash('message','Matrimonio registrado correctamente');
                return Redirect::to('defuncion/create')->with('message','store');
            }
    }

    public function create()
    {
        return view('defuncion.registrar');
    }

    public function registrarDefuncion($valor){

        $objeto = new DefuncioneController;
        $json_recibido = json_decode($valor,true);

        $cui_persona = $json_recibido['cui'];
        $cui_compita = $json_recibido['cuiCompareciente'];
        $municipio = $json_recibido['municipio'];
        $lugar_defuncion = $json_recibido['lugarDefuncion'];
        $fecha_defuncion = $json_recibido['fechaDefuncion'];
        $causa = $json_recibido['causa'];
        
        $response_existencia = $objeto->validarExistenciaCUI($cui_persona);

        if($response_existencia == false){
            
            $resultado_final =[
                'status' => 0,
                'mensaje' => "Defuncion no registrada, el DPI no existe",
                'data' => []
            ];
            
            return response()->json($resultado_final);

        }else{

            $existe_compita = $objeto->validarExistenciaCUI($cui_compita);

            if($existe_compita == true){

                DB::table('DEFUNCION')
                ->insert([
                    'cui_difunto' => $cui_persona,
                    'cui_compareciente' => $cui_compita,
                    'muni_defuncion' => $municipio,
                    'direccion_defuncion' => $lugar_defuncion,
                    'fecha_hora' => Carbon::now(),
                    'causa' => $causa,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $resultado_final =[
                    'status' => 1,
                    'mensaje' => "Defuncion registrada",
                    'data' => []
                ];
                
                return response()->json($resultado_final);

            }else{

                $resultado_final =[
                    'status' => 0,
                    'mensaje' => "Defuncion no registrada, el DPI del compareciente no existe",
                    'data' => []
                ];
                
                return response()->json($resultado_final);
        
            }

        }
    }


    public function validarExistenciaCUI($cui){

        //CODIGO DE LA CONSULTA PARA CONOCER SI EXISTE EL CUI GENERADO

        $existe = DB::table('PERSONA')
        ->select('cui')
        ->where('cui','=',$cui)
        ->get();

        if($existe == "[]")
        {
            return false;
        }else{
            return true;
        }

    }

    public function obtenerDefuncion($cui){
        $person = DB::table('DEFUNCION')
        ->select('*')
        ->where('cui_difunto','=',$cui)
        ->get();

        return $person;
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

            return response()->json($json_response);
        }else{

            $json_response =
            [
                'status' => 1,
                'mensaje' => "DPI encontrado",
                'data' => [$defuncion_obtenida],
            ];
            
            return response()->json($json_response);
        }

    }


}
