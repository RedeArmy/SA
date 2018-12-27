@extends('layouts.admin')

	@section('content')
	<table class="table">
		<thead>
			<th>status</th>
			<th>Mensaje</th>
			<th>Data</th>
		</thead>
			<tbody>
				<td>{{$imp['status']}}</td>
				<td>{{$imp['mensaje']}}</td>
				<td>{{$imp['data']}}</td>
			</tbody>
	</table>
	@endsection