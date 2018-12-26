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

use app\Http\Controllers\ServNacimientoController;

Route::get('/', function () {
    return view('index');
});

Route::get('/nacimiento/', function (){

    $objeto = new ServNacimientoController;
    

    return view('nacimientos');
});

Route::resource('servicionacimiento','ServNacimientoController');

Route::get('api/v1/nacs','ServNacimientoController@getPrueba');

Route::get('api/v1/imprimirNacimiento/{valor}',"ServNacimientoController@imprimirNacimiento");

Route::get('api/v1/registrarNacimiento/{valor}',"ServNacimientoController@registrarNacimiento");


/* Servicios de Departamento y Municipio */
Route::resource('departamento','DepartamentoController');

Route::get('api/v1/dptos','DepartamentoController@getDptos');

Route::get('api/v1/muni/{valor}','MunicipioController@getMuni');

Route::get('api/v1/dpi_consulta/{valor}','DpiController@ConsultarDpi');

Route::get('api/v1/reg_matri/{valor}','MatrimonioController@registrarMatrimonio');
Route::get('api/defuncion/registro_defuncion/{valor}','DefuncioneController@registrarDefuncion');

Route::get('api/defuncion/imprimir_defuncion/{valor}','DefuncioneController@imprimirDefuncion');
