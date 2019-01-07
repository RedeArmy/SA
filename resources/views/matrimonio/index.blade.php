@extends('layouts.admin')
	@section('content')
	{!!Form::open(['route'=>'Matrimonio.results', 'method'=>'POST'])!!}
	<div class="form-group">
		{!!Form::label('hombre','CUI Hombre:')!!}
		{!!Form::text('cuiHombre',null,['class'=>'form-control','placeholder'=>'Ingresa el CUI del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('mujer','CUI Mujer:')!!}
		{!!Form::text('cuiMujer',null,['class'=>'form-control','placeholder'=>'Ingresa el CUI del usuario'])!!}
	</div>
	{!!Form::submit('Buscar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	@endsection