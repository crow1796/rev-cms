@extends('revcms.layout.master')

@section('content')
	<div class="container-fluid _full-spinner-wrapper">
		<div class="rev-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="{{ route('revdashboard') }}">Dashboard</a></li>
				<li class="active">Settings</li>
			</ol>
			<div class="rev-panel">
				<div class="row">
					<div class="col-sm-12 text-center">
						<a href="{{ route('revsettings.general') }}" class="rev-dropdown-menu-card">
							<i class="revicon-settings"></i>
							<span>General Settings</span>
						</a>
						<a href="#" class="rev-dropdown-menu-card">
							<i class="revicon-settings"></i>
							<span>Admin Settings</span>
						</a>
						<a href="#" class="rev-dropdown-menu-card">
							<i class="revicon-package"></i>
							<span>Updates</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection