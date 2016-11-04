@extends('revcms.layout.master')

@section('content')
	<div class="container-fluid _full-spinner-wrapper">
		@include('revcms.layout.partials._spinner')
		<div class="rev-breadcrumb">
			<ol class="breadcrumb">
				<li class="active">Dashboard</li>
			</ol>
		</div>
		<div class="rev-panel">
		</div>
	</div>
@endsection