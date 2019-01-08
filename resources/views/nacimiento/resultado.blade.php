@extends('layouts.admin')
<div class="container">
    <h1>Datos del CUI</h1>
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
        <b>fechaNacimiento : </b>{{$info['data']['fechaNacimiento']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>pais Nacimiento: </b>{{$info['data']['paisNacimiento']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>municipio Nacimiento: </b>{{$info['data']['municipioNacimiento']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>pais Vecindad: </b>{{$info['data']['paisVecindad']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>departamento Vecindad: </b>{{$info['data']['departamentoVecindad']}}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <b>municipio Vecindad: </b>{{$info['data']['municipioVecindad']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <b>estado Civil: </b>{{$info['data']['estadoCivil']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>huella: </b>{{$info['data']['huella']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>fecha Vencimiento: </b>{{$info['data']['fechaVencimiento']}}
        </div>
    </div>
    
</div>