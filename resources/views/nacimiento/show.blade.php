@extends('layouts.admin')
	@section('content')
	{!!Form::open(['route'=>'servicionacimiento.update', 'method'=>'POST'])!!}
        <div class="form-group">
            {!!Form::label('name','ID Pais:')!!}
            {!!Form::text('idpais',null,['class'=>'form-control','placeholder'=>'Ingresa el ID del Pais'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('cui_et','CUI:')!!}
            {!!Form::text('cui_nac',null,['class'=>'form-control','placeholder'=>'Ingrese el CUI'])!!}
        </div>
    {!!Form::submit('Registrar Nacimiento',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}
	@endsection