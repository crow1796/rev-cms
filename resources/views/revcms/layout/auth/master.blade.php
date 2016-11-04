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
		<style type="text/css">
			body{
				overflow-x: hidden;
			}

			#login-bg{
				position: absolute;
			    width: 100%;
			    height: 50%;
			    background: #49636b;
			    top: 0;
			    /*border-top: 5px solid #2c383c;*/
			    /*border-bottom: 5px solid #2c383c;*/
			    /*transform: skewX(-35deg);*/
			    /*left: 35%;*/
			    z-index: -1;
			}

			#form-shadow{
				position: absolute;
				width: 100%;
				height: 5px;
				background: rgba(0, 0, 0, 0.1);
				bottom: -35px;
				left: 0;
				border-radius: 50%;
				box-shadow: 0px 5px 15px rgba(0, 0, 0, .3);
			}
		</style>
	</head>
	<body id="rev-cms-app" class="">
		<div id="page-wrapper">
			<div class="container">
				@yield('content')
			</div>
		</div>
		<div id="login-bg"></div>
		@include('revcms.layout.partials._footer')
		@yield('before_footer_assets')
		@include('revcms.layout.partials._footer-assets')
		@yield('after_footer_assets')
	</body>
</html>