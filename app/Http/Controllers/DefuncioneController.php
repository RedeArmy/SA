<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Redirect;

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
            return $objeto->registrarDefuncion(json_encode($json_response));
            
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
        $lugar_defuncion = $json_recibido['lugarDeDefuncion'];
        $fecha_defuncion = $json_recibido['fechaDeDefuncion'];
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

        return json_encode($person);
    }

    public function obtenerPersona($cui){
        $person = DB::table('PERSONA')
        ->select('*')
        ->where('cui','=',$cui)
        ->get();

        return json_encode($person);
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

    // -------- SERVICIOS POST --------
    // DEFUNCIONES

    public function Registrar(Request $re){
        
        $objeto = new DefuncioneController;
        //$json_recibido = json_decode($valor,true);

        $cui_persona = $re->input('cui');
        $cui_compita = $re->input('cuiCompareciente');
        $municipio =$re->input('municipio'); 
        $lugar_defuncion = $re->input('lugarDeDefuncion');
        $fecha_defuncion = $re->input('fechaDeDefuncion');
        $causa = $re->input('causa');

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

    public function Imprimir(Request $re){
        
        $objeto = new DefuncioneController;

        $valor_cui = $re->input('cui');

        $defuncion_obtenida = json_decode($objeto->obtenerDefuncion($valor_cui),true)[0];

        if($defuncion_obtenida == "[]"){
            
            $json_response =
            [
                'status' => 0,
                'mensaje' => "Registro de defucion con el DPI no encontrado",
                'data' => "{}",
            ];

            return response()->json($json_response);
        }else{

            $persona_dif = json_decode($objeto->obtenerPersona($defuncion_obtenida['cui_difunto']),true)[0];
            $persona_com = json_decode($objeto->obtenerPersona($defuncion_obtenida['cui_compareciente']),true)[0];

            $persona_casada = false;

            $json_respuesta_contenido = [
                "cui" => $defuncion_obtenida['cui_difunto'],
                "nombre" => "",
                "apellido" => "",
                "genero" => "",
                "fechaNacimiento" => "",
                "pais" => "",
                "departamento" => "",
                "municipio" => "",
                "lugarNacimiento" => "",
                "estadoCivil" => "",
                "nombreConyuge" => "",
                "apellidoConyuge" => "",
                "cuiCompareciente" => $defuncion_obtenida['cui_compareciente'],
                "nombreCompareciente" => "",
                "apellidoCompareciente" => "",
                "paisCompareciente" => "",
                "municipioCompareciente" => "",
                "recidenciaCompareciente" => "",
                "paisDefuncion" => "",
                "departamentoDefuncion" => "",
                "lugarDefuncion" => "",
                "fechaDefuncion" => "",
                "causa" => ""
            ];

            $json_response =
            [
                'status' => "1",
                'mensaje' => "DPI encontrado",
                'data' => [$defuncion_obtenida,"",$json_respuesta_contenido]
            ];
            
            return response()->json($json_response);
        }

    }



}
