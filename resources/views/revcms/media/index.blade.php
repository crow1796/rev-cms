@extends('revcms.layout.master')

@section('content')
	<div class="container-fluid">
		@include('revcms.layout.partials._spinner')
		<div class="rev-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="{{ route('revdashboard') }}">Dashboard</a></li>
				<li class="active">Media</li>
			</ol>
		</div>
		<div class="rev-panel">
			<rev-media-library></rev-media-library>
		</div>
	</div>
@endsection