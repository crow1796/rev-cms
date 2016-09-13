@extends('revcms.layout.master')

@section('after_header_assets')
	<script type="text/javascript" src="{{ url('/revcms-deps/tinymce/tinymce.min.js') }}"></script>
@endsection

@section('content')
	<div class="container-fluid">
		<h3 class="page-header">
			Add New Page
		</h3>

		<div class="row">
			<div class="col-sm-6">
				<h4>Action</h4>
				<div id="aceEditor" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;">
					asdasd
				</div>
			</div>
			<div class="col-sm-6">
				<h4>View</h4>
				<div id="aceEditor">
					
				</div>
			</div>
		</div>
	</div>
@endsection