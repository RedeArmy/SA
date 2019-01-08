@extends('layouts.admin')
<div class="container">
    <h1>DATOS DEL MATRIMONIO</h1>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['status']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['mensaje']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['cuiHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['nombreHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['apellidoHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['paisHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['departamentoHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['municipioHombre']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['cuiMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['nombreMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['apellidoMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['paisMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['departamentoMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['municipioMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['municipio']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['lugarMatrimonio']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{ date("Y-m-d H:i:s",strtotime((int)$info['data']['fechaMatrimonio'])) }}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['regimenMatrimonial']}}
        </div>
    </div>
</div>