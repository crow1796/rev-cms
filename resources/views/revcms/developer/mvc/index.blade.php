@extends('revcms.layout.master')

@section('content')
	<div class="container-fluid _full-spinner-wrapper">
		<div class="rev-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="{{ route('revdashboard') }}">Dashboard</a></li>
				<li class="active">MVC</li>
			</ol>
		</div>
		<div class="rev-panel">
			<div class="row">
				<div class="col-sm-12 text-center">
					<a href="#" class="rev-dropdown-menu-card">
						<i class="revicon-inboxes"></i>
						<span>Models</span>
					</a>
					<a href="#" class="rev-dropdown-menu-card">
						<i class="revicon-desktop"></i>
						<span>Views</span>
					</a>
					<a href="{{ route('revdeveloper.mvc.controllers.index') }}" class="rev-dropdown-menu-card">
						<i class="revicon-clipboard-list"></i>
						<span>Controllers</span>
					</a>
				</div>
			</div>
		</div>
	</div>
@endsection