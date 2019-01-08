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
            <b>cui: </b>{{$info['data']['cui']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>nombre: </b>{{$info['data']['nombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>apellido: </b>{{$info['data']['apellido']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>genero: </b>{{$info['data']['genero']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Fecha de Nacimiento: </b>{{$info['data']['fechaNacimiento']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Pais: </b>{{$info['data']['pais']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Departamento: </b>{{$info['data']['departamento']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Municipio: </b>{{$info['data']['municipio']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Lugar de Nacimiento: </b>{{$info['data']['lugarNacimiento']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Estado Civil: </b>{{$info['data']['estadoCivil']}}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <b>nombreConyuge: </b>{{$info['data']['nombreConyuge']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <b>cui: </b>{{$info['data']['apellidoConyuge']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>nombre: </b>{{$info['data']['cuiCompareciente']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>apellido: </b>{{$info['data']['nombreCompareciente']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>genero: </b>{{$info['data']['apellidoCompareciente']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Fecha de Nacimiento: </b>{{$info['data']['paisCompareciente']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Pais: </b>{{$info['data']['departamentoCompareciente']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Departamento: </b>{{$info['data']['municipioCompareciente']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Municipio: </b>{{$info['data']['recidenciaCompareciente']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Lugar de Nacimiento: </b>{{$info['data']['paisDefuncion']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Estado Civil: </b>{{$info['data']['departamentoDefuncion']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Departamento: </b>{{$info['data']['lugarDefuncion']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Municipio: </b>{{$info['data']['fechaDefuncion']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Lugar de Nacimiento: </b>{{$info['data']['causa']}}
        </div>
    </div>
</div>