@extends('layouts.admin')
	@section('content')
	{!!Form::open(['route'=>'imprime.store', 'method'=>'POST'])!!}
	<div class="form-group">
		{!!Form::label('pais','Pais:')!!}
		{!!Form::text('idPais',null,['class'=>'form-control','placeholder'=>'Ingresa el id del pais'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('hombre','CUI Hombre:')!!}
		{!!Form::text('cuiHombre',null,['class'=>'form-control','placeholder'=>'Ingresa el CUI del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('mujer','CUI Mujer:')!!}
		{!!Form::text('cuiMujer',null,['class'=>'form-control','placeholder'=>'Ingresa el CUI del usuario'])!!}
	</div>
	{!!Form::submit('Buscar Matrimonio',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	@endsection