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
            {{$info['status']}}
        </div>
    </div>
</div>