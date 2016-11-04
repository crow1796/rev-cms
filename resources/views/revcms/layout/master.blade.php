<!DOCTYPE html>
<html>
<head>
	<script>
	    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
	    window.base_url = '{{ url('/') }}';
	    window.admin_base_url = '{{ url(trim(config('revcms.uri'), '/')) }}';
	</script>
	@yield('before_header_assets')
	@include('revcms.layout.partials._assets', ['title' => $title])
	@yield('after_header_assets')
</head>
<body id="rev-cms-app">
	<div id="page-wrapper">
		@include('revcms.layout.partials._header')
		@include('revcms.layout.partials._sidebar', ['revActiveMenu' => $revActiveMenu])
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