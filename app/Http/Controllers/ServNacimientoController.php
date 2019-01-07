<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServNacimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('nacimiento.show'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nacimiento.registrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //$json_salida = $objeto->registrarDefuncion(response()->json($request));
        error_log(json_encode($request));
  
        $objeto = new ServNacimientoController;

            $json_response = [
                'nombre' => $request['nombre'],
                'apellido' => $request['apellido'],
                'genero' => $request['genero'],
                'fechaNacimiento' => $request['fechaNacimiento'],
                'municipio' => $request['municipio'],
                'lugarNacimiento' => $request['lugarNacimiento'],
                'cuiPadre' => $request['cuiPadre'],
                'cuiMadre' => $request['cuiMadre']
            ];

            
            //echo "TRABAJO:".json_encode($json_response)."<br>";


            //$json_cosita = ["status" => 1];
            return $objeto->registrarNacimiento(json_encode($json_response));
            //return $json_cosita;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
    //METODOS PROPIOS DE LA CONSOLA

    
    public function valida_CUI_Nacimiento($cui){

        $objeto = new ServNacimientoController;
        $total_sumas = $objeto->FormarCUISumatoria($cui);
        $ultimodigit = $objeto->ObtenerUltimoDigito($cui);
        $valor_bool = $objeto->ValidarUltimoValor($total_sumas,$ultimodigit);

        return $valor_bool;
    }

    public function FormarCUISumatoria($valor){
        
        $array = str_split($valor);
        $num_digits = strlen($valor);
        $total_sumandos = 0;
        for($x = 0; $x < ($num_digits - 1); $x++){
            $valor_multiplicacion = $x + 2;
            $total_sumandos += ($valor_multiplicacion * $array[$x]);
            //echo "Valor inicio: ".$array[$x]." * ".$valor_multiplicacion." = ";
            //echo $total_sumandos;
            //echo "\n";
            //Log::info($total_sumandos);
        }

        return $total_sumandos;
    }

    public function ObtenerUltimoDigito($valor){

        $array_numeros = str_split($valor);
        $longitud_nums = sizeof($array_numeros);

        $ultimo_digito = $array_numeros[$longitud_nums - 1];

        return $ultimo_digito;
        
    }

    public function CalcularModulo11 ($numero){
        $valor_division = $numero % 11;
        $valor_entero = $valor_division;
        //$valor_entero = $valor_division % 1000000000000000000;
        $primer_digito = str_split($valor_entero);
        $longitud_entero = sizeof($primer_digito);
        $primer_digito_v2 = $primer_digito[$longitud_entero - 1];

        ////echo "\n\nValor de Modulo 11 = ".$primer_digito_v2."\n\n";

        return $primer_digito_v2;
    }

    public function ValidarUltimoValor($Sumatoria, $ultimoDigito){
        $objeto = new ServNacimientoController;
        $valor = $objeto->CalcularModulo11($Sumatoria);

        //echo "\nVALIDACION DE VALORES: ".$valor." === ".$ultimoDigito."\n"; 
        
        if($valor == $ultimoDigito){
            //echo 'resultado true';
            return true;
        }
        else{
            //echo 'resultado false';
            return false;
        }

    }

    public function valor_entero(){
        return 24;
    }

    public function getPrueba(){

        $objeto = new ServNacimientoController;

        $validar_cui = $objeto->valor_entero();
        $validar_sal1 = $objeto->valida_CUI_Nacimiento(256461546);
        $validar_sal2 = $objeto->valida_CUI_Nacimiento(224176234);

        return response()->json([
            'nombre' => 'cosa fea',
            'cui_valido1' => $validar_cui,
            'cui_valido2' => $validar_sal1,
            'cui_valido3' => $validar_sal2
        ]);
    }

    public function desmembrarCUI($cui){

        $valores_cui = str_split($cui);
        $longitd_cui = sizeof($valores_cui);

        if($longitd_cui != 13){

            $stuff_respuesta = [
                'estado' => false,
                'mensaje' => 'El cui no es valido por su longitud',
                'valorCUI' => 0
            ];

            return json_encode($stuff_respuesta);
        }
        else{

            $ponderacion = 1;
            $valor_cui_simple = 0;
            for($x =8; $x >= 0; $x--){

                $valor_unitario = $valores_cui[$x];
                ////echo "VALORES: ".$valor_unitario."\n\n";
                $valor_real = $valor_unitario * $ponderacion;
                $ponderacion = $ponderacion * 10;

                $valor_cui_simple += $valor_real;
            }

            $stuff_respuesta = [
                'estado' => true,
                'mensaje' => 'El cui es valido por su longitud',
                'valorCUI' => $valor_cui_simple
            ];

            return json_encode($stuff_respuesta);
        }

    }

    public function generarParteInicial(){
        $numero = 0;
        $ponderador = 1;

        for($x = 0; $x < 8; $x++){
            $numero_random = rand(0,9);
            if($numero_random === 0){
                $numero = $numero * 10;
            }else{
                $numero += ($ponderador * $numero_random);
            }
            $ponderador = $ponderador * 10;
        }
        return $numero;
    }

    public function generarCUI(){

        $objeto = new ServNacimientoController;
        $valor_inicial = $objeto->generarParteInicial();

        //Aumento para apartar el siguiente digito
        $valor_inicial = $valor_inicial * 10;
        $total_sumatodo = $objeto->FormarCUISumatoria($valor_inicial);
        $modulo_valor = $objeto->CalcularModulo11($total_sumatodo);
        
        $valor_inicial = $valor_inicial + $modulo_valor;
  
        return $valor_inicial;
    }

    public function validarExistenciaCUI($cui){

        //CODIGO DE LA CONSULTA PARA CONOCER SI EXISTE EL CUI GENERADO

        $existe = DB::table('PERSONA')
        ->select('cui')
        ->where('cui','=',$cui)
        ->get();

        if($existe == "[]")
        {
            return true;
        }else{
            return false;
        }

    }

    public function obtenerDepartamento($municipio_id){

        //echo "<BR><BR>BUSCANDO EL SIGUIENTE DEPARTAMENTOS:".$municipio_id."<BR><BR><BR>";

        $existe = DB::table('MUNICIPIO')
        ->select('id_dpto')
        ->where('id_muni','=',$municipio_id)
        ->get();

        ////echo "DESDE LA CONSULTA".$existe."<br><br>";

        return json_encode($existe);
    }

    public function obtenerIdPersona(){
        $valor_mayor = DB::table('PERSONA')
        ->max('id');

        //echo "<BR>PROBANDO LAS SIGUIENTES:".$valor_mayor."<BR>";
        return ($valor_mayor + 1);
    }


    /**
     * SERVICIOS WEB - REGISTRAR NACIMIENTOS
     */

    public function registrarNacimiento($valor){

        $objeto = new ServNacimientoController;
        $json_enviado = json_decode($valor,true);


        $nombre = $json_enviado['nombre'];
        $apellido = $json_enviado['apellido'];
        $genero = $json_enviado['genero'];
        $fechaNacimiento = $json_enviado['fechaNacimiento'];
        $municipio = $json_enviado['municipio'];
        $lugarNacimiento = $json_enviado['lugarNacimiento'];
        $cuiPadre = $json_enviado['cuiPadre'];
        $cuiMadre = $json_enviado['cuiMadre'];

        $validadorExistencia = false;
        $cui_generado = 0;

        $id_departamento = json_decode($objeto->obtenerDepartamento($municipio),true);
        
        do{
            $cui_generado = $objeto->generarCUI();
            if(strlen($municipio) == 1)
            {
                $municipio = "0".$municipio;
            }

            //$valor_depto = "1";//
            $valor_depto = $id_departamento[0]['id_dpto']; 
            //echo "<BR> VALOR DEPTO: ".json_encode($id_departamento)."<BR>";
            
            if(strlen((string)$valor_depto) == 1){
                $valor_depto = "0".$valor_depto;
            }

            //echo "<BR> VALOR DEPTO despues : ".$valor_depto."<BR>";

            $cui_final_generado = $cui_generado.$valor_depto.$municipio;
            $validadorExistencia = $objeto->validarExistenciaCUI($cui_final_generado);
        }while($validadorExistencia == false);

        $valor_cui_valodi = $objeto->valida_CUI_Nacimiento($cui_final_generado);
        $valor_fake = $objeto->valida_CUI_Nacimiento(256461546);

      
        //REGISTRO DEL NACIMIENTO EN LA BD

        $valor_id = $objeto->obtenerIdPersona();

        $existe_madre = $objeto->validarExistenciaCUI($cuiMadre);
        $existe_padre = $objeto->validarExistenciaCUI($cuiPadre);

        if($existe_madre == false && $existe_padre == false){
            echo "se pudo realizar el ingreso!!1";
        }

        if($existe_padre == false && $existe_madre == false){

            DB::table('PERSONA')
            ->insert(
                [   'cui'=>$cui_final_generado,
                    'id'=>$valor_id,
                    'nombres'=>$nombre,
                     'apellidos'=>$apellido,
                     'genero'=>$genero,
                     'estado_civil'=>1,
                     'huella'=>"sin valor",
                     'direccion'=>"ciudad",
                     'vivo_muerto'=>1,
                     'id_muni'=>$municipio
                ]
            );

            DB::table('NACIMIENTO')
            ->insert([
                'cui' => $cui_final_generado,
                'cui_padre' => $cuiPadre,
                'cui_madre' => $cuiMadre,
                'id_muni' => $municipio,
                'fecha' => Carbon::now(),
                'direccion_nac' => "ciudad",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
             ]);
            
            $resultado_final =  [
                'cui' => $cui_final_generado,
                'status' => 1,
                'mensaje' => "Registro de persona añadido"
            ];

            return response()->json($resultado_final);
        
        }else{
            
            $resultado_final =  [
                'cui' => 0,
                'status' => 0,
                'mensaje' => "Registro de persona no realizado, no existe padre o madre"
            ];

            return response()->json($resultado_final);

        }

    }

    public function obtenerNacimiento($cui){
        $person = DB::table('NACIMIENTO')
        ->select('*')
        ->where('cui','=',$cui)
        ->get();

        //return $person;
        return json_encode($person);
    }

    public function obtenerPersona($cui){
        $person = DB::table('PERSONA')
        ->select('*')
        ->where('cui','=',$cui)
        ->get();

        //return $person;
        return json_encode($person);
    }

    /**
     * SERVICIOS WEB - IMPRIMIR NACIMIENTOS
     */

    public function imprimirNacimiento($valor){

        $objeto = new ServNacimientoController;
        $json_enviado = json_decode($valor,true);

        $valor_cui = $json_enviado['cui'];
        $valor_desmembrar = $objeto->desmembrarCUI($valor_cui);
        $json_desmembrar = json_decode($valor_desmembrar,true);
        $valor_simple_cui = $json_desmembrar['valorCUI'];


        $valor_cui_valido = $objeto->valida_CUI_Nacimiento($valor_simple_cui);

        if($valor_cui_valido === true){

            $existencia_cui = $objeto->validarExistenciaCUI($valor_cui);

            if($existencia_cui == false){
                //CONSULTA A LA BASE DE DATOS DEL SISTEMA

                $valor_persona_datos = $objeto->obtenerNacimiento($valor_cui);

                $persona_info = [
                    'cui' => '',
                    'nombre' => '',
                    'apellido' => '',
                    'genero' => '',
                    'fechaNacimiento' => '',
                    'pais' => '',
                    'departamento' => '',
                    'municipio' => '',
                    'lugarNacimiento' => '',
                    'cuiPadre' => '',
                    'nombrePadre' => '',
                    'apellidoPadre' => '',
                    'fechaNacimientoPadre' => '',
                    'paisPadre' => '',
                    'departamentoPadre' => '',
                    'municipioPadre' => '',
                    'cuiMadre' => '',
                    'nombreMadre' => '',
                    'apellidoMadre' => '',
                    'fechaNacimientoMadre' => '',
                    'paisMadre' => '',
                    'departamentoMadre' => '',
                    'municipioMadre' => ''
                ];
                
                $json_response =
                [
                    'status' => '1',
                    'mensaje' => "DPI encontrado",
                    'data' => [$valor_persona_datos],
                ];
                
                return response()->json($json_response);

            }else{
                    
                $json_response =
                [
                    'status' => '0',
                    'mensaje' => "No existe el numero de DPI registrado",
                    'data' => "[]",
                ];

                return response()->json($json_response);
            }


        }else{
            
            $json_response =
            [
                'status' => '0',
                'mensaje' => "Número de DPI incorrecto",
                'data' => "[]",
            ];

            return response()->json($json_response);
        }

    }

    public function pruebas(Request $re){
        $data = $re->input("usuario");
        $mensaje = $data."cosa bien hecha";
        return response()->json(["mensaje" => $mensaje]);
    }


    // -------- SERVICIOS POST -----------
    // NACIMIENTOS        

    public function Registrar(Request $re){

        $objeto = new ServNacimientoController;

        $nombre = $re->input('nombre');
        $apellido = $re->input('apellido');
        $genero = $re->input('genero');
        $fechaNacimiento = $re->input('fechaNacimiento');
        $municipio = $re->input('municipio');
        $lugarNacimiento = $re->input('lugarNacimiento');
        $cuiPadre = $re->input('cuiPadre');
        $cuiMadre = $re->input('cuiMadre');

        
        $validadorExistencia = false;
        $cui_generado = 0;

        $id_departamento = json_decode($objeto->obtenerDepartamento($municipio),true);
        
        do{
            $cui_generado = $objeto->generarCUI();
            if(strlen($municipio) == 1)
            {
                $municipio = "0".$municipio;
            }

            //$valor_depto = "1";//
            $valor_depto = $id_departamento[0]['id_dpto']; 
            //echo "<BR> VALOR DEPTO: ".json_encode($id_departamento)."<BR>";
            
            if(strlen((string)$valor_depto) == 1){
                $valor_depto = "0".$valor_depto;
            }

            //echo "<BR> VALOR DEPTO despues : ".$valor_depto."<BR>";

            $cui_final_generado = $cui_generado.$valor_depto.$municipio;
            $validadorExistencia = $objeto->validarExistenciaCUI($cui_final_generado);
        }while($validadorExistencia == false);

        $valor_cui_valodi = $objeto->valida_CUI_Nacimiento($cui_final_generado);
        $valor_fake = $objeto->valida_CUI_Nacimiento(256461546);

      
        //REGISTRO DEL NACIMIENTO EN LA BD

        $valor_id = $objeto->obtenerIdPersona();

        $existe_madre = $objeto->validarExistenciaCUI($cuiMadre);
        $existe_padre = $objeto->validarExistenciaCUI($cuiPadre);

        if($existe_madre == false && $existe_padre == false){
            echo "se pudo realizar el ingreso!!1";
        }

        if($existe_padre == false && $existe_madre == false){

            DB::table('PERSONA')
            ->insert(
                [   'cui'=>$cui_final_generado,
                    'id'=>$valor_id,
                    'nombres'=>$nombre,
                     'apellidos'=>$apellido,
                     'genero'=>$genero,
                     'estado_civil'=>1,
                     'huella'=>"sin valor",
                     'direccion'=>"ciudad",
                     'vivo_muerto'=>1,
                     'id_muni'=>$municipio
                ]
            );

            DB::table('NACIMIENTO')
            ->insert([
                'cui' => $cui_final_generado,
                'cui_padre' => $cuiPadre,
                'cui_madre' => $cuiMadre,
                'id_muni' => $municipio,
                'fecha' => Carbon::now(),
                'direccion_nac' => "ciudad",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
             ]);
            
            $resultado_final =  [
                'cui' => $cui_final_generado,
                'status' => 1,
                'mensaje' => "Registro de persona añadido"
            ];

            return response()->json($resultado_final);
        
        }else{
            
            $resultado_final =  [
                'cui' => 0,
                'status' => 0,
                'mensaje' => "Registro de persona no realizado, no existe padre o madre"
            ];

            return response()->json($resultado_final);

        }
    }

    public function vista(){
        return view('nacimiento.consultar');
    }

    public function mostrar(){
        //retornar vista con los datos    
    }
    
    public function Imprimir(Request $re){

        $objeto = new ServNacimientoController;
    
        $valor_cui = $re->input('cui');

        $valor_desmembrar = $objeto->desmembrarCUI($valor_cui);
        $json_desmembrar = json_decode($valor_desmembrar,true);
        $valor_simple_cui = $json_desmembrar['valorCUI'];

        

        $valor_cui_valido = $objeto->valida_CUI_Nacimiento($valor_simple_cui);

        if($valor_cui_valido === true){

            $existencia_cui = $objeto->validarExistenciaCUI($valor_cui);

            if($existencia_cui == false){
                //CONSULTA A LA BASE DE DATOS DEL SISTEMA

                $valor_persona_datos = $objeto->obtenerNacimiento($valor_cui);
                $json_persona = json_decode($valor_persona_datos,true);
                $persona_1 = json_decode($objeto->obtenerPersona($valor_cui),true)[0];
                $persona_p = json_decode($objeto->obtenerPersona($json_persona[0]['cui_padre']),true)[0];
                $persona_m = json_decode($objeto->obtenerPersona($json_persona[0]['cui_madre']),true)[0];

                $id_departamento = json_decode($objeto->obtenerDepartamento($json_persona[0]['id_muni']),true);
                
                
                $persona_info = [
                    'cui' => $persona_1['cui'],
                    'nombre' => $persona_1['nombres'],
                    'apellido' => $persona_1['apellidos'],
                    'genero' => $persona_1['genero'],
                    'fechaNacimiento' => $json_persona[0]['fecha'],
                    'pais' => '1',
                    'departamento' => $id_departamento,
                    'municipio' => $json_persona[0]['id_muni'],
                    'lugarNacimiento' => $json_persona[0]['direccion_nac'],
                    'cuiPadre' => $json_persona[0]['cui_padre'],
                    'nombrePadre' => $persona_p['nombres'],
                    'apellidoPadre' => $persona_p['apellidos'],
                    'fechaNacimientoPadre' => $persona_p['created_at'],
                    'paisPadre' => '1',
                    'departamentoPadre' => '',
                    'municipioPadre' => $persona_p['id_muni'],
                    'cuiMadre' => $json_persona[0]['cui_madre'],
                    'nombreMadre' => $persona_m['nombres'],
                    'apellidoMadre' => $persona_m['apellidos'],
                    'fechaNacimientoMadre' => $persona_m['created_at'],
                    'paisMadre' => '1',
                    'departamentoMadre' => '',
                    'municipioMadre' => $persona_m['id_muni']
                ];

                $json_response =
                [
                    'status' => '1',
                    'mensaje' => "DPI encontrado",
                    'data' => $persona_info,
                ];
                
                return response()->json($json_response);

            }else{
                    
                $json_response =
                [
                    'status' => '0',
                    'mensaje' => "No existe el numero de DPI registrado",
                    'data' => "{}",
                ];

                return response()->json($json_response);
            }


        }else{
            
            $json_response =
            [
                'status' => '0',
                'mensaje' => "Número de DPI incorrecto",
                'data' => "{}",
            ];

            return response()->json($json_response);
        }
    }

}
