@extends('layouts.admin')
	@section('content')
	{!!Form::open(['route'=>'divorcio.store', 'method'=>'POST'])!!}
	<div class="form-group">
		{!!Form::label('hombre','CUI Hombre:')!!}
		{!!Form::text('cuiHombre',null,['class'=>'form-control','placeholder'=>'Ingresa el CUI del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('mujer','CUI Mujer:')!!}
		{!!Form::text('cuiMujer',null,['class'=>'form-control','placeholder'=>'Ingresa el CUI del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('muni','Municipio:')!!}
		{!!Form::text('municipio',null,['class'=>'form-control','placeholder'=>'Ingresa el municipio de divorcio'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('lugar','Lugar de Divorcio:')!!}
		{!!Form::text('lugarDivorcio',null,['class'=>'form-control','placeholder'=>'Ingresa el lugar del divorcio'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('fecha','Fecha de Divorcio:')!!}
		{!!Form::date('fechaDivorcio',null,['class'=>'form-control','placeholder'=>'Ingresa la fecha del divorcio'])!!}
	</div>
	{!!Form::submit('Registrar Divorcio',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	@endsection