<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Objeto;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;

class MatrimonioController extends Controller
{
    
    public function show()
    {
        return view('matrimonio.index');
    }
    

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
            $mensaje= json_decode($objeto->registrarMatrimonio($json_response),true);
            if($mensaje["status"]==-1){
                Session::flash('alert','No se pudo ingresar el matrimonio');
                return Redirect::to('matrimonio/create')->with('message','fail');
            }else{
                Session::flash('message','Matrimonio registrado correctamente');
                return Redirect::to('matrimonio/create')->with('message','store');
            }
            
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
            'mensaje' => 'El acta de matrimonio se recupero con éxito',
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

    public function Registrar(Request $req){

        $cui_esposo = $req->input('cuiHombre');
        $cui_esposa = $req->input('cuiMujer');
        $muni = $req->input('municipio');
        $lugar_matri = $req->input('lugarMatrimonio');
        $fecha = $req->input('fechaMatrimonio');
        $regimen = $req->input('regimenMatrimonial');
        $pais = $req->input('idPais');

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
                ->where('genero','=','0')
            ->get();

        $existe3 = DB::table('MUNICIPIO')
            ->select('id_muni')
            ->where('id_muni','=',$muni)
            ->get();

        if($existe3 == "[]"){
            $d = new Objeto;
            $d->mensaje = "El municipio no existe.";
            $d->status = "-1";
            $d->data = [$existe,$existe2,$existe3];
            return response()->json($d);
        }else if ( $existe == "[]"){
            $d = new Objeto;
            $d->mensaje = "Problemas, el esposo ya esta casado.";
            $d->status = "-1";
            $d->data = [$existe,$existe2,$existe3];
            return response()->json($d);
        }else if ( $existe2 == "[]"){
            $d = new Objeto;
            $d->mensaje = "Problemas, la esposa ya esta casado.";
            $d->status = "-1";
            $d->data = [$existe,$existe2,$existe3];
            return response()->json($d);
        }

        DB::table('MATRIMONIO')->insert([
            [
                'cui_esposo' => $cui_esposo, 
                'cui_esposa' => $cui_esposa,
                'id_muni' => $muni,
                'direccion_matri' => $lugar_matri,
                'regimen_eco' => $regimen,
                'fecha_matri' => date("Y-m-d H:i:s",strtotime((int)$fecha))
            ]
        ]);

        DB::table('PERSONA')
            ->where('cui', $cui_esposa)
            ->orWhere('cui',$cui_esposo)
            ->update(['estado_civil' => 2]);

        $json_response = [
            'mensaje' => 'Matrimonio registrado',
            'status' => '1',
            'data' => [$existe,$existe2,$existe3]
        ];
        
        return response()->json($json_response);
        //{"cuiHombre":"2942637562001","cuiMujer":"2942637562002","municipio":"1","lugarMatrimonio":"Ciudad","fecharMatrimonio":"1999-01-01","regimenMatrimonial":"bianes mancomunados"}
    }

    public function consultar(){
        return view('matrimonio.index');
    }

    public function results(Request $req){
        $objeto = new MatrimonioController;
        $jsonresp = $objeto->Imprimir($req);
        $respData = json_decode($jsonresp);
        if($respData->mensaje=='El acta de matrimonio se recupero con éxito'){
            $dataMat=json_decode($respData->data);
            return view('matrimonio.resultado', compact('dataMat'));
        }
        $messagge=$respData->mensaje;
        return view('matrimonio.error', compact('messagge'));
    }
    
    public function Imprimir(Request $req){

        $cui_esposo = $req['cuiHombre'];
        $cui_esposa = $req['cuiMujer'];

        $existe = DB::table('MATRIMONIO')
            ->select('acta_matrimonio')
            ->where('cui_esposo','=',$cui_esposo)
            ->where('cui_esposa','=',$cui_esposa)
            ->orderByRaw('acta_matrimonio DESC')
            ->get();

        if($existe == "[]"){
                $d = new Objeto;
                $d->mensaje = "El matrimonio buscado no existe";
                $d->status = "0";
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
            'mensaje' => 'El acta de matrimonio se recupero con éxito',
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
