@extends('revcms.layout.master')

@section('content')
	<div class="container-fluid _full-spinner-wrapper">
		@include('revcms.layout.partials._spinner')
		<div class="rev-panel">
			<div class="row">
				<div class="col-sm-12">
					<rev-controllers></rev-controllers>
				</div>
			</div>
		</div>
	</div>
@endsection