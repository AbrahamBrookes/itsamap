@extends('admin.layouts.main')

@section('head')
@endsection
@section('header')
@endsection
@section('nav')
@endsection

@section('content')
<div id=app class=auth>

	<h1>Make a map</h1>
	<form method="POST" action="{{ route('login') }}" class=login>
		@csrf

		<div class="form-group">
			<label for="email">{{ __('E-Mail Address') }}</label>

			<div>
				<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

				@error('email')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
		</div>

		<div class="form-group">
			<label for="password">{{ __('Password') }}</label>

			<div>
				<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

				@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
		</div>

		<div class="form-group">
			<div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

					<label class="form-check-label" for="remember">
						{{ __('Remember Me') }}
					</label>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div>
				<button type="submit" class="btn btn-primary">
					{{ __('Login') }}
				</button>

				@if (Route::has('register'))
					<a class="btn btn-link" href="{{ route('register') }}">
						{{ __('Register') }}
					</a>
				@endif

				@if (Route::has('password.request'))
					<a class="btn btn-link" href="{{ route('password.request') }}">
						{{ __('Forgot Your Password?') }}
					</a>
				@endif
			</div>
		</div>
		
	</form>
</div>
@endsection
