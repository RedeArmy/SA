@extends('layouts.admin')
	@section('content')
	{!!Form::open(['route'=>'imprimeNac.store', 'method'=>'POST'])!!}
	<div class="form-group">
		{!!Form::label('pais','Id Pais:')!!}
		{!!Form::text('idPais',null,['class'=>'form-control','placeholder'=>'Ingresa el Id del Pais'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('dpi','CUI:')!!}
		{!!Form::text('cui',null,['class'=>'form-control','placeholder'=>'Ingresa el CUI'])!!}
	</div>
	{!!Form::submit('Buscar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	@endsection