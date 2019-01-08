@extends('layouts.admin')
<div class="container">
    <h1>Datos del Acta de Divorcio</h1>
    <div class="panel panel-default">
        <div class="panel-body">
            <b>Mensaje: </b>{{$info['mensaje']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <b>cui Hombre: </b>{{$info['data']['cuiHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>nombre Hombre: </b>{{$info['data']['nombreHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>apellido Hombre: </b>{{$info['data']['apellidoHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Pais Hombre: </b>{{$info['data']['paisHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>FDepartamento hombre: </b>{{$info['data']['departamentoHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Municipio Hombre: </b>{{$info['data']['municipioHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>CUI mujer: </b>{{$info['data']['cuiMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Nombre Mujer: </b>{{$info['data']['nombreMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Apellido Mujer: </b>{{$info['data']['apellidoMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Pais Mujer: </b>{{$info['data']['paisMujer']}}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <b>Departamento Mujer: </b>{{$info['data']['departamentoMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <b>Municipio Mujer: </b>{{$info['data']['municipioMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>municipio: </b>{{$info['data']['municipio']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>lugar Divorcio: </b>{{$info['data']['lugarDivorcio']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>fecha Divorcio: </b>{{$info['data']['fechaDivorcio']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>regimen Matrimonial: </b>{{$info['data']['regimenMatrimonial']}}
        </div>
    </div>
</div>