<!DOCTYPE html>
<html>
<head>
	<script>
	    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
	</script>
	@yield('before_header_assets')
	@include('revcms.layout.partials._assets', ['title' => $title])
	@yield('after_header_assets')
</head>
<body id="rev-cms-app" class="{{ \Config::get('revcms.show_header') ? '_header-pad' : '' }}">
	<div id="page-wrapper">
		@include('revcms.layout.partials._sidebar')
		@if(\Config::get('revcms.show_header'))
			@include('revcms.layout.partials._header')
		@endif
		<div id="page-container">
			@yield('content')
		</div>
		@include('revcms.layout.partials._footer')
		@yield('before_footer_assets')
		@include('revcms.layout.partials._footer-assets')
		@yield('after_footer_assets')
	</div>
</body>
</html>