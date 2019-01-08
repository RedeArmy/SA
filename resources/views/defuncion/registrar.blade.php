@extends('layouts.admin')
	@section('content')
	{!!Form::open(['route'=>'defuncion.store', 'method'=>'POST'])!!}
	<div class="form-group">
		{!!Form::label('pais','ID del pais:')!!}
		{!!Form::text('idPais',null,['class'=>'form-control','placeholder'=>'ID del pais'])!!}
	</div>
	
	<div class="form-group">
		{!!Form::label('cui_hombre','CUI muerto:')!!}
		{!!Form::text('cui_muerto',null,['class'=>'form-control','placeholder'=>'Ingresa el CUI del muerto'])!!}
	</div>

	<div class="form-group">
		{!!Form::label('cui_compa','CUI Compareciente:')!!}
		{!!Form::text('cuiCompareciente',null,['class'=>'form-control','placeholder'=>'Ingresa el CUI del compareciente'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('muni','Municipio:')!!}
		{!!Form::text('municipio',null,['class'=>'form-control','placeholder'=>'Ingresa el municipio de muerte'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('lugar','Lugar de Defuncion:')!!}
		{!!Form::text('lugarDefuncion',null,['class'=>'form-control','placeholder'=>'Ingresa el lugar de muerte'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('fecha','Fecha de Defuncion:')!!}
		{!!Form::date('fechaDefuncion',null,['class'=>'form-control','placeholder'=>'Ingresa la fecha de muerte'])!!}
	</div>
    <div class="form-group">

		{!!Form::label('c','Causa:')!!}
		{!!Form::text('causa',null,['class'=>'form-control','placeholder'=>'Ingresa la causa de muerte'])!!}

	</div>
	{!!Form::submit('Registrar Defuncion',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
    @endsection