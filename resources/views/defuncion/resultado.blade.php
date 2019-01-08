@extends('layouts.admin')
<div class="container">
    <h1>Datos del fallecido</h1>
    <div class="panel panel-default">
        <div class="panel-body">
            <b>cui: </b>{{$respData['cui']]}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>nombre: </b>{{$respData['nombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>apellido: </b>{{$respData['apellido']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>genero: </b>{{$respData['genero']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Fecha de Nacimiento: </b>{{$$respData['fechaNacimiento']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Pais: </b>{{$respData['pais']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Departamento: </b>{{$respData['departamento']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Municipio: </b>{{$respData['municipio']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Lugar de Nacimiento: </b>{{$respData['lugarNacimiento']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Estado Civil: </b>{{$respData['estadoCivil']}}
        </div>
    </div>
</div>