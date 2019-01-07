@extends('layouts.admin')
	
    @section('content')
	{!!Form::open(['route'=>'servicionacimiento.Imprimir', 'method'=>'POST'])!!}
	<div>
    {!!Form::label('ingreso','Ingrese su CUI para consultar:')!!}
    </div>
    <div class="form-group">
		{!!Form::label('dpi','CUI:')!!}
		{!!Form::number('cui',null,['class'=>'form-control','placeholder'=>'Ingrese su numero de CUI'])!!}
	</div>
	{!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	@endsection