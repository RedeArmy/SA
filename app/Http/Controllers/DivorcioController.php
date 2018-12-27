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
}
