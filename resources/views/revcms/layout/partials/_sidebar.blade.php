<div class="rev-sidebar">
	<div class="menu-container">
		<ul class="menu">
			<li class="item{{ $revActiveMenu == 1 ? ' active' : '' }}">
				<a href="{{ route('revdashboard') }}">
					<i class="revicon-compass7"></i>
					<span class="title">Dashboard</span>
				</a>
			</li>
			<li class="item{{ $revActiveMenu == 2 ? ' active' : '' }}">
				<a href="{{ route('revpages.index') }}">
					<i class="revicon-book"></i>
					<span class="title">Pages</span>
				</a>
				<ul class="sub-menu">
					<li class="item">
						<a href="{{ route('revpages.index') }}">
							All Pages
						</a>
					</li>
					<li class="item">
						<a href="{{ route('revpages.create') }}">
							Add New
						</a>
					</li>
				</ul>
			</li>
			<li class="item{{ $revActiveMenu == 3 ? ' active' : '' }}">
				<a href="#">
					<i class="revicon-tags"></i>
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
			<li class="item{{ $revActiveMenu == 4 ? ' active' : '' }}">
				<a href="{{ route('revmedia.library') }}">
					<i class="revicon-folders"></i>
					<span class="title">Media</span>
				</a>
				<ul class="sub-menu">
					<li class="item">
						<a href="{{ route('revmedia.library') }}">
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
			<li class="item{{ $revActiveMenu == 5 ? ' active' : '' }}">
				<a href="#">
					<i class="revicon-tag-cord"></i>
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
			<li class="item{{ $revActiveMenu == 6 ? ' active' : '' }}">
				<a href="{{ route('revthemes.installed') }}">
					<i class="revicon-layout3"></i>
					<span class="title">Theme</span>
				</a>
				<ul class="sub-menu">
					<li class="item">
						<a href="{{ route('revthemes.installed') }}">
							Installed
						</a>
					</li>
					<li class="item">
						<a href="#">
							Active
						</a>
					</li>
					<li class="item">
						<a href="#">
							Add Theme
						</a>
					</li>
				</ul>
			</li>
			<li class="item{{ $revActiveMenu == 7 ? ' active' : '' }}">
				<a href="#">
					<i class="revicon-profile-male"></i>
					<span class="title">Users</span>
				</a>
				<ul class="sub-menu">
					<li class="item">
						<a href="#">
							All
						</a>
					</li>
					<li class="item">
						<a href="#">
							Add New
						</a>
					</li>
					<li class="item">
						<a href="#">
							Groups
						</a>
					</li>
				</ul>
			</li>
			<li class="item{{ $revActiveMenu == 8 ? ' active' : '' }}">
				<a href="{{ route('revsettings.index') }}">
					<i class="revicon-gears"></i>
					<span class="title">Settings</span>
				</a>
				<ul class="sub-menu">
					<li class="item">
						<a href="{{ route('revsettings.general') }}">
							General
						</a>
					</li>
					<li class="item">
						<a href="{{ url(trim(config('revcms.uri'), '/') . '/settings/backend') }}">
							Admin Settings
						</a>
					</li>
					<li class="item">
						<a href="#">
							Updates
						</a>
					</li>
				</ul>
			</li>
		</ul>
		{{-- Developer's Menu --}}
		@if(config('revcms.developer_mode'))
			<ul class="menu">
				<li class="item{{ $revActiveMenu == 9 ? ' active' : '' }}">
					<a href="{{ route('revdeveloper.mvc.index') }}">
						<i class="revicon-atom"></i>
						<span class="title">MVC</span>
					</a>
					<ul class="sub-menu">
						<li class="item">
							<a href="{{ url(trim(config('revcms.uri'), '/') . '/developer/mvc/models') }}">
								Models
							</a>
						</li>
						<li class="item">
							<a href="{{ url(trim(config('revcms.uri'), '/') . '/developer/mvc/views') }}">
								Views
							</a>
						</li>
						<li class="item">
							<a href="{{ url(trim(config('revcms.uri'), '/') . '/developer/mvc/controllers') }}">
								Controllers
							</a>
						</li>
					</ul>
				</li>
				<li class="item{{ $revActiveMenu == 10 ? ' active' : '' }}">
					<a href="#">
						<i class="revicon-inboxes"></i>
						<span class="title">Database</span>
					</a>
					<ul class="sub-menu">
						<li class="item">
							<a href="{{ url(trim(config('revcms.uri'), '/') . '/developer/database/migrations') }}">
								Migrations
							</a>
						</li>
						<li class="item">
							<a href="{{ url(trim(config('revcms.uri'), '/') . '/developer/database/seeders') }}">
								Seeders
							</a>
						</li>
					</ul>
				</li>
				<li class="item{{ $revActiveMenu == 11 ? ' active' : '' }}">
					<a href="#">
						<i class="revicon-refresh"></i>
						<span class="title">HTTP</span>
					</a>
					<ul class="sub-menu">
						<li class="item">
							<a href="{{ url(trim(config('revcms.uri'), '/') . '/developer/http/requests') }}">
								Requests
							</a>
						</li>
						<li class="item">
							<a href="{{ url(trim(config('revcms.uri'), '/') . '/developer/http/middlewares') }}">
								Middlewares
							</a>
						</li>
					</ul>
				</li>
			</ul>
		@endif
		{{-- /Developer's Menu --}}
		<ul class="menu">
			@foreach(\RevCMS::router()->customWebRoutes() as $route)
				<li class="item{{ $revActiveMenu == 'custom-menu-' . $loop->iteration ? ' active' : '' }}">
					<a href="{{ url(trim(config('revcms.uri'), '/') . $route['uri']) }}">
						<i class="{{ $route['iconClass'] }}"></i>
						<span class="title">{{ $route['title'] }}</span>
					</a>
					@if(count($route['children']))
						<ul class="sub-menu">
							@foreach($route['children'] as $childRoute)
								<li class="item">
									<a href="{{ url(trim(config('revcms.uri'), '/') . $childRoute['uri']) }}">
										{{ $childRoute['title'] }}
									</a>
								</li>
							@endforeach
						</ul>
					@endif
				</li>
			@endforeach
		</ul>
	</div>
</div>