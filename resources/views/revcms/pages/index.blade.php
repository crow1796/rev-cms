@extends('revcms.layout.master')

@section('content')
	<div class="container-fluid">
		@include('revcms.layout.partials._spinner')
		<div class="rev-panel">
			<rev-pages></rev-pages>
		</div>
	</div>
@endsection