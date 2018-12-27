@extends('layouts.admin')
<?php $message=Session::get('message')?>

@if($message == 'store')
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Matrimonio creado exitosamente
</div>
@endif
@if($message == 'fail')
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Me cague en todo
</div>
@endif
	@section('content')
	{!!Form::open(['route'=>'matrimonio.store', 'method'=>'POST'])!!}
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
		{!!Form::text('municipio',null,['class'=>'form-control','placeholder'=>'Ingresa el municipio de matrimonio'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('lugar','Lugar de Matrimonio:')!!}
		{!!Form::text('lugarMatrimonio',null,['class'=>'form-control','placeholder'=>'Ingresa el lugar del matrimonio'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('fecha','Fecha de Matrimonio:')!!}
		{!!Form::date('fechaMatrimonio',null,['class'=>'form-control','placeholder'=>'Ingresa la fecha del matrimonio'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('regimen','Regimen Matrimonial:')!!}
		{!!Form::text('regimenMatrimonial',null,['class'=>'form-control','placeholder'=>'Ingresa el regimen del matrimonio'])!!}
	</div>
	{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	@endsection