<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Objeto;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;

class DivorcioController extends Controller
{
    public function create()
    {
        return view('divorcio.registrar');
    }
    //
    public function store(Request $request)
    {
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "http://104.196.194.35/divorcio/registrar",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"cuiHombre\" : \"".$request->input('cuiHombre')."\", \"cuiMujer\" : \"".$request->input('cuiMujer')."\",".
                "\"municipio\" : \"".$request->input('municipio')."\", \"lugarDivorcio\" : \"".$request->input('lugarDivorcio')."\",".
                "\"fechaDivorcio\" : \"".$request->input('fechaDivorcio')."\" \n}",
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
                return view('divorcio.error', compact('err'));
            } else {
                $info = json_decode($response, true);

                //$info = $respData['data'];
                return view('divorcio.mostrar',compact('info'));
            }
                   
    }

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

    public function Registrar(Request $req){

        $cui_esposo = $req->input('cuiHombre');
        $cui_esposa = $req->input('cuiMujer');
        $muni = $req->input('municipio');
        $lugar = $req->input('lugarDivorcio');
        $fecha = $req->input('fechaDivorcio');

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
                'fecha_divorcio' => date("Y-m-d H:i:s",strtotime((int)$fecha))
            ]
        ]);

        DB::table('PERSONA')
            ->where('cui', $cui_esposa)
            ->orWhere('cui',$cui_esposo)
            ->update(['estado_civil' => 1]);

        DB::table('MATRIMONIO')
            ->where('cui_esposa', $cui_esposa)
            ->where('cui_esposo',$cui_esposo)
            ->where('vigente',1)
            ->update(['vigente' => 0]);

        $json_response = [
                'mensaje' => 'Divorcio registrado',
                'status' => '1',
                'data' => []       
        ];
            
        return response()->json($json_response);
        //{"cuiHombre":"2942637562001","cuiMujer":"2942637562002","municipio":"1","lugarDivorcio":"sssss","fechaDivorcio":"2000-02-02"}

    }

    public function Imprimir(Request $req){

        $cui_esposo = $req->input('cuiHombre');
        $cui_esposa = $req->input('cuiMujer');

        $existe = DB::table('DIVORCIO')
            ->select('acta_divorcio','id_muni','fecha_divorcio','direccion_divorcio')
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

        $matrimonio = DB::table('MATRIMONIO')
            ->select('*')
            ->where('cui_esposo','=',$cui_esposo)
            ->where('cui_esposa','=',$cui_esposa)
            ->where('vigente','=',0)
            ->get()
            ->first();

        $municipio = DB::table('MUNICIPIO')
            ->select('nombre')
            ->where('id_muni','=',$existe->id_muni)
            ->get()
            ->first();

            $json_response = [
                'mensaje' => 'El acata de divorcio se recupero con éxito',
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
                    'municipioMujer' => $mujer->municipio,
                    'municipio' => $municipio->nombre,
                    'lugarDivorcio' => $existe->direccion_divorcio,
                    'fechaDivorcio' => strtotime((int)$existe->fecha_divorcio)
                    //'regimenMatrimonial' => $matrimonio->regimen_eco
                ]
                
            ];
            return response()->json($json_response);
            //{"cuiHombre":"2942637562001","cuiMujer":"2942637562002"}

    }
}
