@extends('revcms.layout.master')

@section('content')
	<div class="container-fluid _full-spinner-wrapper">
		@include('revcms.layout.partials._spinner')
		<div class="rev-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="{{ route('revdashboard') }}">Dashboard</a></li>
				<li class="active">{{ $title }}</li>
			</ol>
		</div>
		<div class="rev-panel">
			@include($partialName)
		</div>
	</div>
@endsection