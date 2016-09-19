<div class="rev-sidebar">
	<div class="menu-container">
		<ul class="menu">
			<li class="item">
				<a href="{{ url(trim(config('revcms.uri'), '/')) }}">
					<i class="fa fa-dashboard"></i>
					Dashboard
				</a>
			</li>
			<li class="item">
				<a href="{{ url(trim(config('revcms.uri'), '/') . '/pages') }}">
					<i class="fa fa-file-o"></i>
					Page
				</a>
				<ul class="sub-menu">
					<li class="title">
						Page Menu
					</li>
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
					<i class="fa fa-file-text-o"></i>
					Partials
				</a>
				<ul class="sub-menu">
					<li class="title">
						Partials Menu
					</li>
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
				</ul>
			</li>
			<li class="item">
				<a href="{{ url(trim(Config::get('revcms.uri'), '/') . '/media') }}">
					<i class="fa fa-picture-o"></i>
					Media
				</a>
				<ul class="sub-menu">
					<li class="title">
						Media Menu
					</li>
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
					Components
				</a>
				<ul class="sub-menu">
					<li class="title">
						Components Menu
					</li>
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
					Themes
				</a>
				<ul class="sub-menu">
					<li class="title">
						Theme Menu
					</li>
					<li class="item">
						<a href="{{ url(trim(config('revcms.uri'), '/') . '/themes') }}">
							Installed Themes
						</a>
					</li>
					<li class="item">
						<a href="{{ url(trim(config('revcms.uri'), '/') . '/themes') }}">
							Active Theme
						</a>
					</li>
					<li class="item">
						<a href="{{ url(trim(config('revcms.uri'), '/') . '/install') }}">
							Add Theme
						</a>
					</li>
				</ul>
			</li>
			<li class="item">
				<a href="{{ url(trim(config('revcms.uri'), '/') . '/settings') }}">
					<i class="fa fa-cogs"></i>
					Settings
				</a>
				<ul class="sub-menu">
					<li class="title">
						Settings Menu
					</li>
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
				<li class="title">
					Developer Menu
				</li>
				<li class="item">
					<a href="{{ url('#') }}" 
						@click="$event.preventDefault()">
						<i class="fa fa-gamepad"></i>
						MVC
					</a>
					<ul class="sub-menu">
						<li class="title">MVC Menu</li>
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
						Database
					</a>
					<ul class="sub-menu">
						<li class="title">
							Database Menu
						</li>
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
						HTTP
					</a>
					<ul class="sub-menu">
						<li class="title">
							HTTP Menu
						</li>
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
	</div>
</div>