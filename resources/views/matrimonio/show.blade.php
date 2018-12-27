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
				<td>{{}}</td>
				<td>{{}}</td>
				<td>{{$imprimir}}</td>
			</tbody>
	</table>
	@endsection