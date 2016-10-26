@extends('revcms.layout.master')

@section('content')
	<div class="container-fluid _full-spinner-wrapper">
		@include('revcms.layout.partials._spinner')
		<div class="rev-panel">
			<rev-create-page>
			</rev-create-page>
		</div>
	</div>
@endsection