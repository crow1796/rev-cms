<div class="rev-sidebar">
	<div class="menu-container">
		<ul class="menu">
			<li class="item">
				<a href="{{ url('admin') }}">
					<i class="fa fa-dashboard"></i>
					Dashboard
				</a>
			</li>
			<li class="item">
				<a href="{{ url('admin/pages') }}">
					<i class="fa fa-file-o"></i>
					Page
				</a>
				<ul class="sub-menu">
					<li class="title">
						Page Menu
					</li>
					<li class="item">
						<a href="{{ url('admin/pages') }}">
							All Pages
						</a>
					</li>
					<li class="item">
						<a href="{{ url('admin/pages/create') }}">
							Add New
						</a>
					</li>
				</ul>
			</li>
			<li class="item">
				<a href="{{ url('admin/contents') }}">
					<i class="fa fa-file-text-o"></i>
					Contents
				</a>
				<ul class="sub-menu">
					<li class="title">
						Contents Menu
					</li>
					<li class="item">
						<a href="#">
							All Contents
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
				<a href="{{ url('/admin/media') }}">
					<i class="fa fa-picture-o"></i>
					Media
				</a>
				<ul class="sub-menu">
					<li class="title">
						Media Menu
					</li>
					<li class="item">
						<a href="{{ url('/admin/media') }}">
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
				<a href="{{ url('admin/components') }}">
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
				<a href="{{ url('admin/settings') }}">
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
				</ul>
			</li>
		</ul>
	</div>
</div>