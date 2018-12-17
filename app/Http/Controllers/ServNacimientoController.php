<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServNacimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $valor_division = $numero / 11;
        $valor_entero = $valor_division % 1000000000000000000;
        $primer_digito = str_split($valor_entero);
        $longitud_entero = sizeof($primer_digito);
        $primer_digito_v2 = $primer_digito[$longitud_entero - 1];

        //echo "\n\nValor de Modulo 11 = ".$primer_digito_v2."\n\n";

        return $primer_digito_v2;
    }

    public function ValidarUltimoValor($Sumatoria, $ultimoDigito){
        $objeto = new ServNacimientoController;
        $valor = $objeto->CalcularModulo11($Sumatoria);

        //echo "\nVALIDACION DE VALORES: ".$valor." === ".$ultimoDigito."\n"; 

        if($valor === $ultimoDigito){
            return true;
        }
        else{
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
                //echo "VALORES: ".$valor_unitario."\n\n";
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
/*
        echo "\n<br>";
        echo "\n<br>";

        echo "CUI GENERADO: ".$valor_inicial;
*/      
        return $valor_inicial;
    }

    public function validarExistenciaCUI($cui){

        //CODIGO DE LA CONSULTA PARA CONOCER SI EXISTE EL CUI GENERADO

        return false;
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

        do{
            $cui_generado = $objeto->generarCUI();
            $validadorExistencia = $objeto->validarExistenciaCUI($cui_generado);

        }while($validadorExistencia != false);

        $valor_cui_valodi = $objeto->valida_CUI_Nacimiento($cui_generado);
        $valor_fake = $objeto->valida_CUI_Nacimiento(256461546);

        echo "<br><br><br><br><br>CUI GENERADO ES VALIDO: ".$valor_cui_valodi."<br>";
        echo "CUI GENERADO ES VALIDO: ".$valor_fake."<br>";
        echo "<br>CUI: ".$cui_generado."<br>";
        

        //REGISTRO DEL NACIMIENTO EN LA BD




        
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

        //echo "Buscando el Nacimiento: ".$valor_cui."\n";
        //echo "Valor del CUI Basico: ".$valor_simple_cui."\n";

        $valor_cui_valido = $objeto->valida_CUI_Nacimiento($valor_simple_cui);

        if($valor_cui_valido === true){
            echo "DPI CORRECTO";

            //CONSULTA A LA BASE DE DATOS DEL SISTEMA

            $json_response = [

            ];
            
            return response()->json($json_response);

        }else{
            echo "DPI INCORRECTO\n";

            $json_response = [
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
                'municipioMadre' => '',
                'codigoMensaje' => '0',
                'mensaje' => 'Error el DPI, no es valido.'
            ];

            return response()->json($json_response);
        }

    }
}
