@extends('revcms.layout.master')

@section('content')
	<div class="container-fluid">
		@include('revcms.layout.partials._spinner')
		<rev-themes></rev-themes>
	</div>
@endsection