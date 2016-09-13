<div class="rev-navbar -fixed -top -default">
	<a class="navbar-brand" href="#">{{ \Config::get('revcms.title') }}</a>
	<div class="right">
		<a href="{{ url('/') }}" target="_blank" class="rev-btn -sm -danger">
			Preview Site <i class="fa fa-external-link"></i>
		</a>
		<div class="rev-dropdown">
			<a href="#" class="rev-btn -sm -link" dropdown-toggle="rev-dropdown">
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
		</div>
	</div>
</div>