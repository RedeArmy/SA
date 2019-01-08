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
        <b>pais Nacimiento: </b>{{$info['data']['pais']}}
        </div>
    </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Departamento Nacimiento: </b>{{$info['data']['departamento']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Municipio Nacimiento: </b>{{$info['data']['municipio']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>lugar Nacimiento: </b>{{$info['data']['lugarNacimiento']}}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <b>cui Padre: </b>{{$info['data']['cuiPadre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <b>nombre Padre: </b>{{$info['data']['nombrePadre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>apellido Padre: </b>{{$info['data']['apellidoPadre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>cui Madre: </b>{{$info['data']['cuiMadre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <b>nombre Madre: </b>{{$info['data']['nombreMadre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>apellido Madre: </b>{{$info['data']['apellidoMadre']}}
        </div>
    </div>
</div>