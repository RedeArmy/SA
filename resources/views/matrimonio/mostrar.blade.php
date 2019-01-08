@extends('layouts.admin')
<div class="container">
    <h1>DATOS DEL MATRIMONIO</h1>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Status: </b>{{$info['status']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Mensaje: </b>{{$info['mensaje']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>CUI Esposo: </b>{{$info['data']['cuiHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Nombre Esposo: </b>{{$info['data']['nombreHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Apellido Esposo: </b>{{$info['data']['apellidoHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Pais Esposo: </b>{{$info['data']['paisHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Departamento Esposo: </b>{{$info['data']['departamentoHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Municipio Esposo: </b>{{$info['data']['municipioHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>CUI Esposa: </b>{{$info['data']['cuiMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Nombre Esposa: </b>{{$info['data']['nombreMujer']}}
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
        <b>Municipio Esposa: </b>{{$info['data']['municipioMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Municipio: </b>{{$info['data']['municipio']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Direccion: </b>{{$info['data']['lugarMatrimonio']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Fecha: </b>{{ date("Y-m-d H:i:s",strtotime((int)$info['data']['fechaMatrimonio'])) }}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Regimen Matrimonial: </b>{{$info['data']['regimenMatrimonial']}}
        </div>
    </div>
</div>