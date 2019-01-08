@extends('layouts.admin')
	@section('content')
	{!!Form::open(['route'=>'imprimeDiv.store', 'method'=>'POST'])!!}
	<div class="form-group">
		{!!Form::label('pais','Id Pais:')!!}
		{!!Form::text('idPais',null,['class'=>'form-control','placeholder'=>'Ingresa el Id del Pais'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('dpi2','CUI Hombre:')!!}
		{!!Form::text('cuiHombre',null,['class'=>'form-control','placeholder'=>'Ingresa el CUI del Hombre'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('dpi1','CUI Mujer:')!!}
		{!!Form::text('cuiMujer',null,['class'=>'form-control','placeholder'=>'Ingresa el CUI del usuario'])!!}
	</div>
	{!!Form::submit('Buscar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	@endsection