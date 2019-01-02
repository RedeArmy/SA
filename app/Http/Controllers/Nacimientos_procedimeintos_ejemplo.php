<?php
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
