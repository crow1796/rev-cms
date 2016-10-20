<div class="rev-navbar -fixed -top -default">
	<a class="navbar-brand" href="{{ url(\Config::get('revcms.uri')) }}">{{ \Config::get('revcms.title') }}</a>
	<div class="right _relative">
		<a href="{{ url('/') }}" target="_blank">
			Preview Site 
			<i class="fa fa-external-link"></i>
		</a>
			
		<a href="#rev-header-user-dropdown"
			data-toggle="rev-dropdown">
			Joshua Tundag<i class="fa fa-caret-down"></i>
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
						@if(config('revcms.user_mode'))
							<button type="button" class="mode rev-btn -flat {{ config('revcms.user_mode') == 'developer' ? '-danger' : '-success' }}">
								{{ config('revcms.user_mode') == 'developer' ? 'Dev' : 'Simple' }} Mode
							</button>
						@endif
					</div>
				</div>
			</li>
			<li class="item">
				<a href="{{ url(config('revcms.uri') . '/user/') }}">
					Settings
				</a>
			</li>
			<li class="item">
				<a href="{{ url(config('revcms.uri') . '/user/') }}">
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