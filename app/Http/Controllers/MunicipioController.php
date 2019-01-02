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

    public function getMuni($valor){
        $json_recibido = json_decode($valor,true);
        $id_dpto = $json_recibido['idDepartamento'];
        $d = new Municipio;

        $existe = DB::table('DEPARTAMENTO')
            ->select('id_dpto')
            ->where('id_dpto','=',$id_dpto)
            ->get();

        if($existe == "[]"){
            $d->mensaje = "No hay Departamento con ese codigo";
            $d->status = "-1";
            $d->data = [];
            return response()->json($d);
        }

        $dptos = DB::table('MUNICIPIO')
            ->select('id_muni as idMunicipio', 'nombre as municipio')
            ->where('id_dpto','=',$id_dpto)
            ->get();

        $d->mensaje = "Lista de municipios recuperada con exito";
        $d->status = '1';
        $d->data = new Municipio;
        $d->data->listaMunicipios = $dptos;
        return response()->json($d);
    }

    public function ListaMunis(Request $req){

        $id_dpto = $req['idDepartamento'];
        $d = new Municipio;

        $existe = DB::table('DEPARTAMENTO')
            ->select('id_dpto')
            ->where('id_dpto','=',$id_dpto)
            ->get();

        if($existe == "[]"){
            $d->mensaje = "No hay Departamento con ese codigo";
            $d->status = "-1";
            $d->data = [];
            return response()->json($d);
        }

        $dptos = DB::table('MUNICIPIO')
            ->select('id_muni as idMunicipio', 'nombre as municipio')
            ->where('id_dpto','=',$id_dpto)
            ->get();

        $d->mensaje = "Lista de municipios recuperada con exito";
        $d->status = '1';
        $d->data = new Municipio;
        $d->data->listaMunicipios = $dptos;
        return response()->json($d);
    }
}
