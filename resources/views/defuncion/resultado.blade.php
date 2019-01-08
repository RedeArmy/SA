@extends('layouts.admin')
<div class="container">
    <h1>Datos del fallecido</h1>
    @foreach($respData as $data)
    <div class="panel panel-default">
        <div class="panel-body">
            <b>dfsf: </b>{{$data}}            
        </div>
    </div>
    @endforeach
</div>