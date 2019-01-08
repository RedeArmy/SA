@extends('layouts.admin')
<div class="container">
    <h1>Datos de Matrimonio</h1>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['mensaje']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$info['data']['cuiMujer']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        {{$info['data']['cuiHombre']}}
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
        {{$info['data']['fechaMatrimonio']}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
        {{$info['data']['regimenMatrimonial']}}
        </div>
    </div>
</div>