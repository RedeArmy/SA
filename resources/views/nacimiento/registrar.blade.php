@extends('layouts.admin')
	@section('content')
	{!!Form::open(['route'=>'servicionacimiento.store', 'method'=>'POST'])!!}
	<div class="form-group">
		{!!Form::label('name','Nombre:')!!}
		{!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('apell','Apellido:')!!}
		{!!Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Ingresa el Apellido del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('gen','Genero:')!!}
		{!!Form::text('genero',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('fecha','Fecha Nacimiento:')!!}
		{!!Form::date('fechanacimiento',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('muni','Municipio:')!!}
		{!!Form::text('municipio',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('dir','Direccion:')!!}
		{!!Form::text('lugarNacimiento',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('papa','CUI Padre:')!!}
		{!!Form::text('cuiPadre',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('mama','Cui Madre:')!!}
		{!!Form::text('cuiMadre',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
	</div>
	{!!Form::submit('Registrar Nacimiento',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	@endsection