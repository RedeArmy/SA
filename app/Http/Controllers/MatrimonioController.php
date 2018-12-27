<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Objeto;
use Illuminate\Support\Facades\DB;


class MatrimonioController extends Controller
{
    
    public function create()
    {
        return view('matrimonio.registrar');
    }
    public function store(Request $request)
    {
        //
        //$json_salida = $objeto->registrarDefuncion(response()->json($request));
        error_log(json_encode($request));
        $json_response= '{'. '"cuiHombre":"'.$request['cuiHombre'] .'","cuiMujer":"'.$request['cuiMujer'].
            '","municipio":"'.$request['municipio'].'","lugarMatrimonio":"'.$request['lugarMatrimonio'].
            '","fechaMatrimonio":"'.$request['fechaMatrimonio'].'","regimenMatrimonial":"'.$request['regimenMatrimonial'] .'"}';
            $objeto = new MatrimonioController;
            echo 'salida:' . $json_response;
            return $objeto->registrarMatrimonio($json_response);
    }
    public function registrarMatrimonio($valor){
        $json_recibido = json_decode($valor,true);

        $cui_esposo = $json_recibido['cuiHombre'];
        $cui_esposa = $json_recibido['cuiMujer'];
        $muni = $json_recibido['municipio'];
        $lugar_matri = $json_recibido['lugarMatrimonio'];
        $fecha = $json_recibido['fechaMatrimonio'];
        $regimen = $json_recibido['regimenMatrimonial'];
        

        $existe = DB::table('PERSONA')
            ->select('cui')
            ->where(
                'cui','=',$cui_esposo)
                ->where('estado_civil','<>','2')
                ->where('genero','=','1')
            ->get();

        $existe2 = DB::table('PERSONA')
            ->select('cui')
            ->where(
                'cui','=',$cui_esposa)
                ->where('estado_civil','<>','2')
                ->where('genero','=','2')
            ->get();

        $existe3 = DB::table('MUNICIPIO')
            ->select('id_muni')
            ->where('id_muni','=',$muni)
            ->get();

        if($existe == "[]" || $existe2 == "[]" || $existe3 == "[]"){
            $d = new Objeto;
            $d->mensaje = "Problemas con el cui o con Municipio";
            $d->status = "-1";
            $d->data = [];
            return response()->json($d);
        }

        DB::table('MATRIMONIO')->insert([
            [
                'cui_esposo' => $cui_esposo, 
                'cui_esposa' => $cui_esposa,
                'id_muni' => $muni,
                'direccion_matri' => $lugar_matri,
                'regimen_eco' => $regimen,
                'fecha_matri' => $fecha
            ]
        ]);

        DB::table('PERSONA')
            ->where('cui', $cui_esposa)
            ->orWhere('cui',$cui_esposo)
            ->update(['estado_civil' => 2]);

        $json_response = [
            'mensaje' => 'Matrimonio registrado',
            'status' => '1',
            'data' => []
            
        ];
        
        return response()->json($json_response);
        //{"cuiHombre":"2942637562001","cuiMujer":"2942637562002","municipio":"1","lugarMatrimonio":"Ciudad","fecharMatrimonio":"1999-01-01","regimenMatrimonial":"bianes mancomunados"}
    }

    public function consultarMatrimonio($valor){
        $json_recibido = json_decode($valor,true);

        $cui_esposo = $json_recibido['cuiHombre'];
        $cui_esposa = $json_recibido['cuiMujer'];

        $existe = DB::table('MATRIMONIO')
            ->select('acta_matrimonio')
            ->where('cui_esposo','=',$cui_esposo)
            ->where('cui_esposa','=',$cui_esposa)
            ->orderByRaw('acta_matrimonio DESC')
            ->get();

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

        if($existe == "[]"){
                $d = new Objeto;
                $d->mensaje = "El matrimonio buscado no existe";
                $d->status = "-1";
                $d->data = [];
                return response()->json($d);
        }

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
    }
}
