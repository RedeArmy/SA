<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Objeto;
use Illuminate\Support\Facades\DB;

class DivorcioController extends Controller
{
    //
    public function registrarDivorcio($valor){
        $json_recibido = json_decode($valor,true);

        $cui_esposo = $json_recibido['cuiHombre'];
        $cui_esposa = $json_recibido['cuiMujer'];
        $muni = $json_recibido['municipio'];
        $lugar = $json_recibido['lugarDivorcio'];
        $fecha = $json_recibido['fechaDivorcio'];

        $existe = DB::table('MATRIMONIO')
            ->select('acta_matrimonio')
            ->where('cui_esposo','=',$cui_esposo)
            ->where('cui_esposa','=',$cui_esposa)
            ->orderByRaw('acta_matrimonio DESC')
            ->get()
            ->first();

        if($existe == ""){
                $d = new Objeto;
                $d->mensaje = "El matrimonio buscada no es valido";
                $d->status = "-1";
                $d->data = [];
                return response()->json($d);
        }

        DB::table('DIVORCIO')->insert([
            [
                'cui_esposo' => $cui_esposo, 
                'cui_esposa' => $cui_esposa,
                'id_muni' => $muni,
                'direccion_divorcio' => $lugar,
                'fecha_divorcio' => $fecha
            ]
        ]);

        DB::table('PERSONA')
            ->where('cui', $cui_esposa)
            ->orWhere('cui',$cui_esposo)
            ->update(['estado_civil' => 1]);

        $json_response = [
                'mensaje' => 'Divorcio registrado',
                'status' => '1',
                'data' => []       
        ];
            
        return response()->json($json_response);
        //{"cuiHombre":"2942637562001","cuiMujer":"2942637562002","municipio":"1","lugarDivorcio":"sssss","fechaDivorcio":"2000-02-02"}

    }

    public function consultarDivorcio($valor){
        $json_recibido = json_decode($valor,true);

        $cui_esposo = $json_recibido['cuiHombre'];
        $cui_esposa = $json_recibido['cuiMujer'];

        $existe = DB::table('DIVORCIO')
            ->select('acta_divorcio')
            ->where('cui_esposo','=',$cui_esposo)
            ->where('cui_esposa','=',$cui_esposa)
            ->orderByRaw('acta_divorcio DESC')
            ->get()
            ->first();

        if($existe == ""){
                $d = new Objeto;
                $d->mensaje = "El acta de divorcio buscada no es válido";
                $d->status = "-1";
                $d->data = [];
                return response()->json($d);
        }

        $hombre = DB::table('PERSONA')
            ->join('MUNICIPIO','PERSONA.id_muni','=','MUNICIPIO.id_muni')
            ->join('DEPARTAMENTO','MUNICIPIO.id_dpto','=','DEPARTAMENTO.id_dpto')
            ->join('PAIS','DEPARTAMENTO.id_pais','=','PAIS.id_pais')
            ->select('PERSONA.nombres', 'PERSONA.apellidos','PERSONA.genero','MUNICIPIO.nombre as municipio',
                    'DEPARTAMENTO.nombre_dpto as departamento','PAIS.nombre_pais as pais')
            ->where('PERSONA.cui','=',$cui_esposo)
            ->get()
            ->first();

        $mujer = DB::table('PERSONA')
            ->join('MUNICIPIO','PERSONA.id_muni','=','MUNICIPIO.id_muni')
            ->join('DEPARTAMENTO','MUNICIPIO.id_dpto','=','DEPARTAMENTO.id_dpto')
            ->join('PAIS','DEPARTAMENTO.id_pais','=','PAIS.id_pais')
            ->select('PERSONA.nombres', 'PERSONA.apellidos','PERSONA.genero','MUNICIPIO.nombre as municipio',
                    'DEPARTAMENTO.nombre_dpto as departamento','PAIS.nombre_pais as pais')
            ->where('PERSONA.cui','=',$cui_esposa)
            ->get()
            ->first();

            $json_response = [
                'mensaje' => 'El acata de matrimonio se recupero con éxito',
                'status' => '1',
                'data' => [
                    'cuiHombre' => $cui_esposo,
                    'nombreHombre' => $hombre->nombres,
                    'apellidoHombre' => $hombre->apellidos,
                    'paisHombre' => $hombre->pais,
                    'departamentoHombre' => $hombre->departamento,
                    'municipioHombre' => $hombre->municipio,
                    'cuiMujer' => $cui_esposa,
                    'nombreMujer' => $mujer->nombres,
                    'apellidoMujer' => $mujer->apellidos,
                    'paisMujer' => $mujer->pais,
                    'departamentoMujer' => $mujer->departamento,
                    'municipioMujer' => $mujer->municipio
    
                ]
                
            ];
            return response()->json($json_response);
            //{"cuiHombre":"2942637562001","cuiMujer":"2942637562002"}

    }
}