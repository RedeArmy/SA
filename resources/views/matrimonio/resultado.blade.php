@extends('layouts.admin')
<div class="container">
    <h1>Datos de Matrimonio</h1>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Mensaje: </b>{{$info['mensaje']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>CUI Esposa: </b>{{$info['data']['cuiMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>CUI Esposo: </b>{{$info['data']['cuiHombre']}}
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
        <b>Fecha: </b>{{$info['data']['fechaMatrimonio']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        <b>Regimen Matrimonial: </b>{{$info['data']['regimenMatrimonial']}}
        </div>
    </div>
</div>