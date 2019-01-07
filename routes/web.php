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

Route::get('api/v1/nacs','ServNacimientoController@getPrueba');
/*Route::resource('imprime','imprimeController');
Route::resource('matrimonio','MatrimonioController');
Route::get('matrimonio/mostrar','MatrimonioController@mostrar');
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


// SERVICIOS - NUEVAS RUTAS

Route::post('/nacimiento/registrar','ServNacimientoController@Registrar');
Route::post('/nacimiento/imprimir','ServNacimientoController@vista');

Route::post('/defuncion/registrar','DefuncioneController@Registrar');
Route::post('/defuncion/imprimir','DefuncioneController@Imprimir');

Route::post('/matrimonio/registrar','MatrimonioController@Registrar');
Route::get('/matrimonio/imprimir',function(){
    return view('matrimonio.index');
});
Route::post('/matrimonio/imprimir','MatrimonioController@results');

Route::post('/divorcio/registrar','DivorcioController@Registrar');
Route::post('/divorcio/imprimir','DivorcioController@Imprimir');

Route::post('/municipio/lista','MunicipioController@ListaMunis');
Route::post('/departamento/lista','DepartamentoController@ListaDptos');

Route::post('/dpi/consultar','DpiController@Consultar');
Route::post('/dpi/actualizar','DpiController@Actualizar');
