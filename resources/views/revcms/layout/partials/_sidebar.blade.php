<div class="rev-sidebar">
	<div class="menu-container">
		<ul class="menu">
			<li class="item">
				<a href="{{ url(trim(config('revcms.uri'), '/')) }}">
					<i class="fa fa-dashboard"></i>
					<span class="title">Dashboard</span>
				</a>
			</li>
			<li class="item">
				<a href="{{ url(trim(config('revcms.uri'), '/') . '/pages') }}">
					<i class="fa fa-file-o"></i>
					<span class="title">Pages</span>
				</a>
				<ul class="sub-menu">
					<li class="item">
						<a href="{{ url(trim(config('revcms.uri'), '/') . '/pages') }}">
							All Pages
						</a>
					</li>
					<li class="item">
						<a href="{{ url(trim(config('revcms.uri'), '/') . '/pages/create') }}">
							Add New
						</a>
					</li>
				</ul>
			</li>
			<li class="item">
				<a href="{{ url(trim(config('revcms.uri'), '/') . '/partials') }}">
					<i class="fa fa-tags"></i>
					<span class="title">Partials</span>
				</a>
				<ul class="sub-menu">
					<li class="item">
						<a href="#">
							All Partials
						</a>
					</li>
					<li class="item">
						<a href="#">
							Add New
						</a>
					</li>
					<li class="item">
						<a href="#">
							Menus
						</a>
					</li>
				</ul>
			</li>
			<li class="item">
				<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/media') }}">
					<i class="fa fa-picture-o"></i>
					<span class="title">Media</span>
				</a>
				<ul class="sub-menu">
					<li class="item">
						<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/media') }}">
							Library
						</a>
					</li>
					<li class="item">
						<a href="#">
							Upload
						</a>
					</li>
				</ul>
			</li>
			<li class="item">
				<a href="{{ url(trim(config('revcms.uri'), '/') . '/components') }}">
					<i class="fa fa-puzzle-piece"></i>
					<span class="title">Components</span>
				</a>
				<ul class="sub-menu">
					<li class="item">
						<a href="#">
							Installed
						</a>
					</li>
					<li class="item">
						<a href="#">
							Add New
						</a>
					</li>
				</ul>
			</li>
			<li class="item">
				<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/themes') }}">
					<i class="fa fa-television"></i>
					<span class="title">Theme</span>
				</a>
				<ul class="sub-menu">
					<li class="item">
						<a href="{{ url(trim(config('revcms.uri'), '/') . '/themes') }}">
							Installed
						</a>
					</li>
					<li class="item">
						<a href="{{ url(trim(config('revcms.uri'), '/') . '/themes/active') }}">
							Active
						</a>
					</li>
					<li class="item">
						<a href="{{ url(trim(config('revcms.uri'), '/') . '/themes/install') }}">
							Add Theme
						</a>
					</li>
				</ul>
			</li>
			<li class="item">
				<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/users') }}">
					<i class="fa fa-user"></i>
					<span class="title">Users</span>
				</a>
				<ul class="sub-menu">
					<li class="item">
						<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/users') }}">
							All
						</a>
					</li>
					<li class="item">
						<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/users/create') }}">
							Add New
						</a>
					</li>
					<li class="item">
						<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/users/groups') }}">
							Groups
						</a>
					</li>
				</ul>
			</li>
			<li class="item">
				<a href="{{ url(trim(config('revcms.uri'), '/') . '/settings') }}">
					<i class="fa fa-cogs"></i>
					<span class="title">Settings</span>
				</a>
				<ul class="sub-menu">
					<li class="item">
						<a href="#">
							Maintenance Mode
						</a>
					</li>
					<li class="item">
						<a href="#">
							Updates
						</a>
					</li>
					<li class="item">
						<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/settings/backend') }}">
							Admin Settings
						</a>
					</li>
				</ul>
			</li>
		</ul>
		{{-- Developer's Menu --}}
		@if(\Config::get('revcms.developer_mode'))
			<ul class="menu">
				<li class="item">
					<a href="{{ url('#') }}" 
						@click="$event.preventDefault()">
						<i class="fa fa-gamepad"></i>
						<span class="title">MVC</span>
					</a>
					<ul class="sub-menu">
						<li class="item">
							<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/developer/mvc/models') }}">
								Models
							</a>
						</li>
						<li class="item">
							<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/developer/mvc/views') }}">
								Views
							</a>
						</li>
						<li class="item">
							<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/developer/mvc/controllers') }}">
								Controllers
							</a>
						</li>
					</ul>
				</li>
				<li class="item">
					<a href="#" 
						@click="$event.preventDefault()">
						<i class="fa fa-database"></i>
						<span class="title">Database</span>
					</a>
					<ul class="sub-menu">
						<li class="item">
							<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/developer/database/migrations') }}">
								Migrations
							</a>
						</li>
						<li class="item">
							<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/developer/database/seeders') }}">
								Seeders
							</a>
						</li>
					</ul>
				</li>
				<li class="item">
					<a href="#" 
						@click="$event.preventDefault()">
						<i class="fa fa-refresh"></i>
						<span class="title">HTTP</span>
					</a>
					<ul class="sub-menu">
						<li class="item">
							<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/developer/http/requests') }}">
								Requests
							</a>
						</li>
						<li class="item">
							<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/developer/http/middlewares') }}">
								Middlewares
							</a>
						</li>
					</ul>
				</li>
			</ul>
		@endif
		{{-- /Developer's Menu --}}
		<ul class="menu">
		
		</ul>
	</div>
</div>