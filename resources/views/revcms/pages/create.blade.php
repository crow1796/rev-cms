@extends('revcms.layout.master')

@section('after_header_assets')
	<style>
		#action-editor,
		#view-editor{
			height: 400px;
		}
	</style>
@endsection

@section('content')
	<rev-create-page>
	</rev-create-page>
@endsection