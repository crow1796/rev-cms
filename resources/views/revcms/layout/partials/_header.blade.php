<div class="rev-navbar -top -default{{ config('revcms.sticky_header') ? ' -fixed' : ' -absolute' }}">
	@if(config('revcms.show_logo'))
		<a class="navbar-brand" href="{{ url( config('revcms.uri')) }}">
			@if(!config('revcms.logo_url'))
				{{ config('revcms.title') }}
			@else
				<img src="{{ config('revcms.logo_url') }}" alt="{{ config('revcms.title') }}">
			@endif
		</a>
	@endif
	<div class="right _relative">
		<a href="{{ url('/') }}" target="_blank">
			Preview Site 
			<i class="fa fa-external-link"></i>
		</a>
			
		<a href="#rev-header-user-dropdown"
			data-toggle="rev-dropdown">
			Joshua Tundag <i class="fa fa-caret-down"></i>
		</a>
		<ul class="rev-dropdown-toggle animated"
			id="rev-header-user-dropdown">
			<li class="item _relative">
				<div class="rev-user-info">
					<div class="image">
						<img src="{{ url('/images/welcome-featured-bg.jpg') }}">
					</div>
					<div class="info">
						<span class="fullname">Joshua Tundag</span>
						<span class="role">Administrator</span>
						<button type="button" class="mode rev-btn -danger">
							{{ config('revcms.developer_mode') ? 'Dev' : 'Simple' }} Mode
						</button>
					</div>
				</div>
			</li>
			<li class="item">
				<a href="{{ url(config('revcms.uri') . '/user/') }}">
					<i class="fa fa-inbox"></i>
					Messages
				</a>
			</li>
			<li class="item">
				<a href="{{ url(config('revcms.uri') . '/user/') }}">
					<i class="fa fa-globe"></i>
					Notifications
				</a>
			</li>
			<li class="item">
				<a href="{{ url(config('revcms.uri') . '/user/') }}">
					<i class="revicon-settings"></i>
					Settings
				</a>
			</li>
			<li class="item">
				<a href="{{ url(config('revcms.uri') . '/user/') }}">
					<i class="revicon-switch"></i>
					Sign Out
				</a>
			</li>
		</ul>
		{{-- <a href="{{ url('/') }}" target="_blank" class="rev-btn -sm -danger">
			Preview Site <i class="fa fa-external-link"></i>
		</a>
		<div class="rev-dropdown">
			<a href="#" class="rev-btn -sm -danger" dropdown-toggle="rev-dropdown">
				Joshua Tundag <i class="fa fa-caret-down"></i>
			</a>
			<ul class="sub-menu -down">
				<li class="item">
					<a href="#">
						My Account
					</a>
				</li>
				<li class="item">
					<a href="#">
						Sign Out
					</a>
				</li>
			</ul>
		</div> --}}
	</div>
</div>