<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Municipio;
use Illuminate\Support\Facades\DB;

class MunicipioController extends Controller
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

    /**
     * 
     */
    public function getMunicipios($param){
        $request->validate([
            'idDepartamento' => 'required|exists:DEPARTAMENTO,id_dpto'
        ]);

        $dptos = DB::table('MUNICIPIO')
            ->select('id_muni as idMunicipio', 'nombre as municipio')
            ->where('id_dpto','=',$request->get('idDepartamento'))
            ->get();
        $d = new Municipio;
        $d->mensaje = "
        Lista de municipios recuperada con exito";
        $d->codigoMensaje = '1';
        $d->Municipios = $dptos;
        return response()->json($d);
    }

    public function getMuni($valor){
        $json_recibido = json_decode($valor,true);
        $id_dpto = $json_recibido['idDepartamento'];
        $d = new Municipio;

        $existe = DB::table('DEPARTAMENTO')
            ->select('id_dpto')
            ->where('id_dpto','=',$id_dpto)
            ->get();

        if(!existeDpto()){
            $d = new Municipio;
            $d->mensaje = "No hay Departamento con ese codigo";
            $d->codigoMensaje = "-1";
            $d->Municipios = [];
            return response()->json($d);
        }

        $dptos = DB::table('MUNICIPIO')
            ->select('id_muni as idMunicipio', 'nombre as municipio')
            ->where('id_dpto','=',$id_dpto)
            ->get();

        $d->mensaje = "Lista de municipios recuperada con exito";
        $d->codigoMensaje = '1';
        $d->Municipios = $dptos;
        return response()->json($d);
    }

    public function existeDpto($id_dpto){
        $existe = DB::table('DEPARTAMENTO')
            ->select('id_dpto')
            ->where('id_dpto','=',$id_dpto)
            ->get();

        if($existe == "[]"){
            return false;
        }

        return true;
    }
}
