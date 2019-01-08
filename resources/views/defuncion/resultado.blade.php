@extends('layouts.admin')
<div class="container">
    <h1>Datos del fallecido</h1>
    <div class="panel panel-default">
        <div class="panel-body">
            <b>Mensaje: </b>{{$info['mensaje']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <b>cui: </b>{{$info['cui']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>nombre: </b>{{$info['nombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>apellido: </b>{{$info['apellido']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>genero: </b>{{$info['genero']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Fecha de Nacimiento: </b>{{$info['fechaNacimiento']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Pais: </b>{{$info['pais']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Departamento: </b>{{$info['departamento']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Municipio: </b>{{$info['municipio']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Lugar de Nacimiento: </b>{{$info['lugarNacimiento']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Estado Civil: </b>{{$info['estadoCivil']}}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <b>nombreConyuge: </b>{{$info['nombreConyuge']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <b>cui: </b>{{$info['apellidoConyuge']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>nombre: </b>{{$info['cuiCompareciente']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>apellido: </b>{{$info['nombreCompareciente']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>genero: </b>{{$info['apellidoCompareciente']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Fecha de Nacimiento: </b>{{$info['paisCompareciente']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Pais: </b>{{$info['departamentoCompareciente']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Departamento: </b>{{$info['municipioCompareciente']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Municipio: </b>{{$info['recidenciaCompareciente']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Lugar de Nacimiento: </b>{{$info['paisDefuncion']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Estado Civil: </b>{{$info['departamentoDefuncion']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Departamento: </b>{{$info['lugarDefuncion']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Municipio: </b>{{$info['fechaDefuncion']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Lugar de Nacimiento: </b>{{$info['causa']}}
        </div>
    </div>
</div>