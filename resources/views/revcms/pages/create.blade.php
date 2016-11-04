@extends('revcms.layout.master')

@section('content')
	<div class="container-fluid _full-spinner-wrapper">
		@include('revcms.layout.partials._spinner')
		<div class="rev-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="{{ route('revdashboard') }}">Dashboard</a></li>
				<li><a href="{{ route('revpages.index') }}">Pages</a></li>
				<li class="active">Create Page</li>
			</ol>
		</div>
		<div class="rev-panel">
			<rev-create-page>
			</rev-create-page>
		</div>
	</div>
@endsection