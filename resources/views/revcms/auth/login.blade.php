@extends('revcms.layout.auth.master')

@section('after_header_assets')
	<style type="text/css">
		.login-form form button[type="submit"]{
			padding-right: 56px;
		}
		.login-form form button[type="submit"]:after{
			transition: all .3s ease;
			content: "\e929";
		    position: absolute;
		    width: 30px;
		    height: 30px;
		    background: white;
		    right: 0;
		    top: 0;
		    border-top-right-radius: 3px;
		    border-bottom-right-radius: 3px;
		    color: red;
		    font-family: icomoon;
		    line-height: 30px;
		    overflow: hidden;
		}
	</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4 login-form" style="margin-top: 200px; margin-bottom: 200px;">
			<form method="POST" action="{{ url(trim(\Config::get('revcms.uri'), '/') . '/login') }}">
				<h2 class="text-center">Login</h2>
				{!! csrf_field() !!}
				<div class="rev-field-group">
					<input type="text" name="username" id="username" class="rev-field -lg _block" placeholder="Username or Email">
				</div>
				<div class="rev-field-group">
					<input type="password" name="password" id="password" class="rev-field -lg _block" placeholder="Password">
				</div>
				<div class="rev-field-group">
					<label for="remember">
						<input type="checkbox" name="remember" id="remember" class="rev-checkbox -danger _no-margin"> Remember Me?
					</label>
				</div>
				<div class="rev-field-group text-right">
					<button type="submit" class="rev-btn -md -danger">
						Login
					</button>
				</div>
				<div id="form-shadow"></div>
			</form>
		</div>
	</div>
@endsection