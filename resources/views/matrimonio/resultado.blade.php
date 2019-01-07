@extends('layouts.admin')
<div class="container">
    <h1>Datos de Matrimonio</h1>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$dataMat->cuiHombre}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$dataMat->nombreHombre}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$dataMat->apellidoHombre}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$dataMat->paisHombre}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$dataMat->departamentoHombre}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$dataMat->municipioHombre}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$dataMat->cuiMujer}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$dataMat->nombreMujer}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            {{$dataMat->apellidoMujer}}
        </div>
    </div>

</div>