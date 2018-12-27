@extends('layouts.admin')

	@section('content')
	<table class="table">
		<thead>
			<th>status</th>
			<th>Mensaje</th>
			<th>Data</th>
		</thead>
			<tbody>
				<td>{{$imprimir['status']}}</td>
				<td>{{$imprimir['mensaje']}}</td>
				<td>{{$imprimir['data']}}</td>
			</tbody>
	</table>
	@endsection