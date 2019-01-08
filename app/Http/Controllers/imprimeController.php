<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class imprimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //return view('matrimonio.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('matrimonio.index'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$json_response= '{'. '"cuiHombre":"'.$request['cuiHombre'] .'","cuiMujer":"'.$request['cuiMujer'].'"}';
        $objeto = new MatrimonioController;
        $imprimir=$objeto->consultarMatrimonio($json_response);
        return view('matrimonio.show', compact('imprimir'));*/
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://104.196.194.35/matrimonio/imprimir",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n\t\"cuiHombre\" : \""+$request['cuiHombre']+"\", \"cuiMujer\" : \""+$request['cuiMujer']+"\"  \n}",
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
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
        return $response;
    }

    
    public function show()
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
}
