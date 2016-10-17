@extends('revcms.layout.auth.master')

@section('content')
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4 rev-card" style="margin-top: 120px;">
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
			</form>
		</div>
	</div>
@endsection