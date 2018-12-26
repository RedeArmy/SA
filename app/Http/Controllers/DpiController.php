<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dpi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DpiController extends Controller
{
    //

    public function ConsultarDPI($json){

        $json_recibido = json_decode($json,true);
        $cui = $json_recibido['cui'];
        $d = new Dpi;
        
        $existe = DB::table('PERSONA')
            ->select('cui')
            ->where('cui','=',$cui)
            ->get();

        if($existe == "[]"){
            $d->mensaje = "No hay Persona con ese cui";
            $d->status = "-1";
            $d->data = [];
            return response()->json($d);
        }

        $lugares = DB::table('NACIMIENTO')
            ->join('MUNICIPIO','NACIMIENTO.id_muni','=','MUNICIPIO.id_muni')
            ->join('DEPARTAMENTO','MUNICIPIO.id_dpto','=','DEPARTAMENTO.id_dpto')
            ->select('MUNICIPIO.nombre as municipioNacimiento','DEPARTAMENTO.nombre_dpto as departamentoNacimiento')
            ->where('NACIMIENTO.cui','=',$cui)
            ->get()
            ->first();

        $persona = DB::table('PERSONA')
            ->join('NACIMIENTO','PERSONA.cui','=','NACIMIENTO.cui')
            ->join('MUNICIPIO','PERSONA.id_muni','=','MUNICIPIO.id_muni')
            ->join('DEPARTAMENTO','MUNICIPIO.id_dpto','=','DEPARTAMENTO.id_dpto')
            ->join('DPI','PERSONA.cui','=','DPI.cui_persona')
            ->join('PAIS','DEPARTAMENTO.id_pais','=','PAIS.id_pais')
            ->select('PERSONA.cui', 'PERSONA.nombres as nombre', 'PERSONA.apellidos as apellido','PERSONA.genero','NACIMIENTO.fecha','MUNICIPIO.nombre as municipioVecindad',
                    'DEPARTAMENTO.nombre_dpto as departamentoVecindad','PAIS.nombre_pais as paisNacimiento','PAIS.nombre_pais as paisVecindad','PERSONA.estado_civil',
                    'PERSONA.huella','DPI.fecha_vence')
            ->where('PERSONA.cui','=',$cui)
            ->get()
            ->first();

            $json_response = [
                'mensaje' => 'Todo OK',
                'status' => '1',
                'data' => [
                    'cui' => $cui,
                    'nombre' => $persona->nombre,
                    'apellido' => $persona->apellido,
                    'genero' => $persona->genero,
                    'fechaNacimiento' => $persona->fecha,
                    'paisNacimiento' => $persona->paisNacimiento,
                    'departamentoNacimiento' => $lugares->departamentoNacimiento,
                    'municipioNacimiento' => $lugares->municipioNacimiento,
                    'paisVecindad' => $persona->paisVecindad,
                    'departamentoVecindad' => $persona->departamentoVecindad,
                    'municipioVecindad' => $persona->municipioVecindad,
                    'estadoCivil' => $persona->estado_civil,
                    'huella' => $persona->huella,
                    'fechaVecimiento' => $persona->fecha_vence

                ]
                
            ];

        $d->mensaje = "Lista de municipios recuperada con exito";
        $d->status = '1';
        $d->data = $persona;
        return response()->json($json_response);
        
    }

    
    
}