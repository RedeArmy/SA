@extends('layouts.admin')

	@section('content')
	<table class="table">
		<thead>
			<th>status</th>
			<th>Mensaje</th>
			<th>Data</th>
		</thead>
			<tbody>
                {{$imprime=json_encode($imprimir,true)}}
				<td>{{$imprime['status']}}</td>
				<td>{{$imprime['mensaje']}}</td>
				<td>{{$imprime['data']}}</td>
			</tbody>
	</table>
	@endsection