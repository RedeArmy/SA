@extends('layouts.admin')
	@section('content')
	{!!Form::open(['route'=>'imprimeDef.store', 'method'=>'POST'])!!}
	<div class="form-group">
		{!!Form::label('pais','Id Pais:')!!}
		{!!Form::text('idPais',null,['class'=>'form-control','placeholder'=>'Ingresa el Id del Pais'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('dpi','CUI:')!!}
		{!!Form::text('cui',null,['class'=>'form-control','placeholder'=>'Ingresa el CUI del usuario'])!!}
	</div>
	{!!Form::submit('Buscar Defuncion',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	@endsection