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

Route::get('/', function () {
    return view('welcome');
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
