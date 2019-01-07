<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//namespace app\Http\Controllers;
//use Illuminate\Routing\Controller;
//use ServNacimientoController;

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
});

Route::get('/', 'HomeController@index');

/*Route::get('/nacimiento/', function (){
    return view('nacimiento.registrar');
});
*/


Route::resource('servicionacimiento','ServNacimientoController');

//Route::get('api/v1/nacs','ServNacimientoController@getPrueba');
Route::resource('imprime','imprimeController');
Route::resource('matrimonio','MatrimonioController');
/*Route::get('matrimonio/mostrar','MatrimonioController@mostrar');
Route::get('api/v1/reg_matri/{valor}','MatrimonioController@registrarMatrimonio');
Route::get('api/v1/consul_matri/{valor}','MatrimonioController@consultarMatrimonio');
*/

//SERVICIOS DE DEFUNCION
Route::resource('defuncion','DefuncioneController');
Route::get('api/defuncion/registro_defuncion/{valor}','DefuncioneController@registrarDefuncion');
Route::get('api/defuncion/imprimir_defuncion/{valor}','DefuncioneController@imprimirDefuncion');


//SERVICIOS DE DIVORCIO
Route::resource('divorcio','DivorcioController');
Route::get('api/divorcio/registro_divorcio/{valor}','DivorcioController@registrarDivorcio');
Route::get('api/divorcio/consultar_divorcio/{valor}','DivorcioController@consultarDivorcio');

//SERVICIOS CON POST
Route::post('/login2','ServNacimientoController@pruebas');

Route::post('/login',function(Request $re){
 
    $usuario = $re->input("usuario");
    $password = $re->input("password");
 
    if($usuario == "AndoCodeando" && $password == "1.2..3...")
        return response()->json(["mensaje" => "hola " . $usuario]);
    else
        return response()->json(["mensaje" => "login fallido"]);
    
});

Route::get('/iniciov2', function(){

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://104.196.194.35/defuncion/imprimir",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\n\t\"cui\" : \"2967871080332\" \n}",
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

});


Route::post('/retorno',function(){
    return response()->json(['mensaje'=>'hola mundo']);
});

// SERVICIOS - NUEVAS RUTAS

Route::post('/nacimiento/registrar','ServNacimientoController@Registrar');
Route::post('/nacimiento/imprimir','ServNacimientoController@vista');

Route::post('/defuncion/registrar','DefuncioneController@Registrar');
Route::post('/defuncion/imprimir','DefuncioneController@Imprimir');

Route::post('/matrimonio/registrar','MatrimonioController@Registrar');
Route::post('/matrimonio/imprimir','MatrimonioController@Imprimir');

Route::post('/divorcio/registrar','DivorcioController@Registrar');
Route::post('/divorcio/imprimir','DivorcioController@Imprimir');

Route::post('/municipio/lista','MunicipioController@ListaMunis');
Route::post('/departamento/lista','DepartamentoController@ListaDptos');
Route::get('/departamento/lista','DepartamentoController@ListaDptos');

Route::post('/dpi/consultar','DpiController@Consultar');
Route::post('/dpi/actualizar','DpiController@Actualizar');
