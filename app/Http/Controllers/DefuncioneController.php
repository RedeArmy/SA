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
    
    public function show(Request $request){
        $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://104.196.194.35/defuncion/imprimir",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\n\t\"cui\" : \"".$request->input('cui')."\" \n}",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Postman-Token: 2b655ed0-d367-49ef-9a7d-22c349f78a3b",
        "cache-control: no-cache"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        $err="cURL Error #:" . $err;
        return view('defuncion.error', compact('err'));
    } else {
        $respData = json_decode($response, true);

        $info = $respData['data'];
        return view('defuncion.resultado',compact('info'));
    }
    }

    public function store(Request $request){
        
        /*error_log(json_encode($request));
        
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
            return $objeto->registrarDefuncion(json_encode($json_response));*/
            //falta definir varios atributos
            $curl = curl_init();
            $cuimuerto=(int)$request->input('cui');
            $cuicompareciente=(int)$request->input('cuiCompareciente');
            curl_setopt_array($curl, array(
            CURLOPT_URL => "http://104.196.194.35/defuncion/Registrar",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"cui\" : \"".$cuimuerto."\", \"cuiCompareciente\" : \"".$cuicompareciente."\"".
                ", \"municipio\" : \"".$request->input('municipio')."\", \"lugarDeDefuncion\" : \"".$request->input('lugarDeDefuncion')."\", ".
                "\"fechaDeDefuncion\" : \"".$request->input('fechaDeDefuncion')."\", \"causa\" : \"".$request->input('causa')."\" \n}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Postman-Token: 2b655ed0-d367-49ef-9a7d-22c349f78a3b",
                "cache-control: no-cache"
            ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
                $err="cURL Error #:" . $err;
                return view('defuncion.error', compact('err'));
            } else {
                $respData = json_decode($response, true);

                $info = $respData['data'];
                return view('defuncion.resultado',compact('info'));
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
        $lugar_defuncion = $json_recibido['lugarDeDefuncion'];
        $fecha_defuncion = $json_recibido['fechaDeDefuncion'];
        $causa = $json_recibido['causa'];
        
        $response_existencia = $objeto->validarExistenciaCUI($cui_persona);

        if($response_existencia == false){
            
            $resultado_final =[
                'status' => -1,
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
                    'status' => -1,
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

    public function obtenerNacimiento($cui){
        $person = DB::table('NACIMIENTO')
        ->select('*')
        ->where('cui','=',$cui)
        ->get();
        
        return json_encode($person);
    }

    public function obtenerMatrimonio($cui, $tipo){

        if($tipo == 1){
            //hombre

            $person = DB::table('MATRIMONIO')
            ->select('*')
            ->where('cui_esposo','=',$cui)
            ->get();
            
            return json_encode($person);
        }else{    
            $person = DB::table('MATRIMONIO')
            ->select('*')
            ->where('cui_esposa','=',$cui)
            ->get();
            
            return json_encode($person);
        }
        
    }

    public function imprimirDefuncion($valor){

        $objeto = new DefuncioneController;
        $json_recibido = json_decode($valor,true);

        $valor_cui = $json_recibido['cui'];

        $defuncion_obtenida = $objeto->obtenerDefuncion($valor_cui);

        if($defuncion_obtenida == "[]"){
            
            $json_response =
            [
                'status' => -1,
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
                'status' => -1,
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
                    'fecha_hora' => date("Y-m-d H:i:s",strtotime((int)$fecha_defuncion)),
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
                    'status' => -1,
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
                'status' => -1,
                'mensaje' => "Registro de defucion con el DPI no encontrado",
                'data' => "{}",
            ];

            return response()->json($json_response);
        }else{

            $persona_dif = json_decode($objeto->obtenerPersona($defuncion_obtenida['cui_difunto']),true)[0];
            $persona_com = json_decode($objeto->obtenerPersona($defuncion_obtenida['cui_compareciente']),true)[0];
            $nacimiento_dif = json_decode($objeto->obtenerNacimiento($defuncion_obtenida['cui_difunto']),true)[0];

            $persona_casada = $persona_dif['estado_civil'];
            
            $json_casado;

            if($persona_casada == 1){
                //PERSONA CASADA
                $json_casado = [
                    'nombre_c' => "",
                    'apellido_c' => "",
                ];
            }else{
                //PERSONA SOLTERA
                $matrimonio;
                $persona_casada;

                if($persona_dif['genero'] == 1){
                    $matrimonio = json_decode($objeto->obtenerMatrimonio($defuncion_obtenida['cui_difunto'],1),true)[0];
                    $persona_casada = json_decode($objeto->obtenerPersona($matrimonio['cui_esposa'],0),true)[0];
                }else{
                    $matrimonio = json_decode($objeto->obtenerMatrimonio($defuncion_obtenida['cui_difunto'],0),true)[0];
                    $persona_casada = json_decode($objeto->obtenerPersona($matrimonio['cui_esposo'],0),true)[0];
                }

                $json_casado = [
                    'nombre_c' => $persona_casada['nombres'],
                    'apellido_c' => $persona_casada['apellidos']
                ];
            }


            $json_respuesta_contenido = [
                "cui" => $defuncion_obtenida['cui_difunto'],
                "nombre" => $persona_dif['nombres'],
                "apellido" => $persona_dif['apellidos'],
                "genero" => $persona_dif['genero'],
                "fechaNacimiento" => strtotime($nacimiento_dif['fecha']),
                "pais" => "6",
                "departamento" => "",
                "municipio" => $persona_dif['id_muni'],
                "lugarNacimiento" => $nacimiento_dif['direccion_nac'],
                "estadoCivil" => $persona_dif['estado_civil'],
                "nombreConyuge" => $json_casado['nombre_c'],
                "apellidoConyuge" => $json_casado['apellido_c'],
                "cuiCompareciente" => $defuncion_obtenida['cui_compareciente'],
                "nombreCompareciente" => $persona_com['nombres'],
                "apellidoCompareciente" => $persona_com['apellidos'],
                "paisCompareciente" => "6",
                "municipioCompareciente" => $persona_com['id_muni'],
                "recidenciaCompareciente" => $persona_com['direccion'],
                "paisDefuncion" => "6",
                "departamentoDefuncion" => "",
                "lugarDefuncion" => $defuncion_obtenida['direccion_defuncion'],
                "fechaDefuncion" => "",
                "causa" => $defuncion_obtenida['causa']
            ];

            $json_response =
            [
                'status' => "1",
                'mensaje' => "DPI encontrado",
                'data' => $json_respuesta_contenido
                //'data' => [$defuncion_obtenida,"",$json_respuesta_contenido,"",$persona_dif, "", $persona_com]
            ];
            
            return response()->json($json_response);
        }

        
        $json_response =
        [
            'status' => -1,
            'mensaje' => "Registro de defucion con el DPI no encontrado",
            'data' => "{}",
        ];

        return response()->json($json_response);

    }



}
