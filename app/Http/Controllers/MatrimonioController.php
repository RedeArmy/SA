<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Objeto;
use Illuminate\Support\Facades\DB;


class MatrimonioController extends Controller
{
    //
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
                ->where('vivo_muerto','=','1')
            ->get();

        $existe2 = DB::table('PERSONA')
            ->select('cui')
            ->where(
                'cui','=',$cui_esposa)
                ->where('estado_civil','<>','2')
                ->where('genero','=','0')
                ->where('vivo_muerto','=','1')
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
}
