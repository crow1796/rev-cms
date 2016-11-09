@extends('revcms.layout.master')

@section('content')
	<div class="container-fluid _full-spinner-wrapper">
		<div class="rev-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="{{ route('revdashboard') }}">Dashboard</a></li>
				<li><a href="{{ route('revsettings.index') }}">Settings</a></li>
				<li class="active">General Settings</li>
			</ol>
		</div>
		<div class="rev-panel">
			<form action="{{ route('revsettings.updategeneralsettings') }}" method="POST">
				{!! csrf_field() !!}
				@if(session()->has('message') || session()->has('error'))
					<div class="row">
						<div class="col-sm-12">
							@if(session()->has('message'))
								<div class="rev-alert -success">
								{{ session()->get('message') }}
							@else
								<div class="rev-alert -danger">
								{{ session()->get('error') }}
							@endif
							</div>
						</div>
					</div>
				@endif
				<div class="row">
					<div class="col-sm-6">
						<div class="rev-field-group">
							<label for="title">Site Title</label>
							<input type="text" name="title" id="title" class="rev-field -lg _block" placeholder="Enter Site Title" value="{{ $title }}">
						</div>
						<div class="rev-field-group">
							<label for="uri">Admin URI</label>
							<input type="text" name="uri" id="uri" class="rev-field -lg _block" placeholder="Enter Admin URI" value="{{ $uri }}">
						</div>
						<div class="rev-field-group">
							<label for="sticky_header">
								<input type="checkbox" name="sticky_header" id="sticky_header" class="rev-checkbox" {{ $sticky_header ? 'checked': '' }}>
								Enable Sticky Header?
							</label>
						</div>
						<div class="rev-field-group">
							<label for="developer_mode">
								<input type="checkbox" name="developer_mode" id="developer_mode" class="rev-checkbox" {{ $developer_mode ? 'checked': '' }}>
								Enable Developer Mode?
							</label>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="rev-field-group">
							<label for="controller_base_path">Controller Base Path</label>
							<input type="text" name="controller_base_path" id="controller_base_path" class="rev-field -lg _block" placeholder="Enter Controller Base Path" value="{{ $controller_base_path }}">
						</div>
						<div class="rev-field-group">
							<label for="model_base_path">Model Base Path</label>
							<input type="text" name="model_base_path" id="model_base_path" class="rev-field -lg _block" placeholder="Enter Model Base Path" value="{{ $model_base_path }}">
						</div>
						<div class="rev-field-group">
							<label for="views_base_path">View Base Path</label>
							<input type="text" name="views_base_path" id="views_base_path" class="rev-field -lg _block" placeholder="Enter View Base Path" value="{{ $views_base_path }}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="rev-field-group text-right">
							<button type="submit" class="rev-btn -md -danger -has-icon-right">
								Save
								<span class="icon">
									<i class="revicon-note-checked"></i>
								</span>
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection