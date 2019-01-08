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
</div>