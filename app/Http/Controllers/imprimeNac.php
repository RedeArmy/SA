<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class imprimeNac extends Controller
{
    public function create()
    {
        return view('nacimiento.index'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $curl = curl_init();

            curl_setopt_array($curl, array(
        CURLOPT_URL => "http://104.196.194.35/nacimiento/imprimir",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n\t\"cui\" : \"".$request->input('cui')."\" \n}",
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
            return view('nacimiento.error', compact('err'));
        } else {
            $info = json_decode($response, true);
            $info['data']['paisNacimiento']=$request->input('idPais');
            //$info = $respData['data'];
            return $response;
            //return view('nacimiento.resultado',compact('info'));
        }
    }
}
