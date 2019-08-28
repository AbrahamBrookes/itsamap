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
	<form method="POST" action="{{ route('register') }}" class=register>
		@csrf

		<div class="form-group">
			<label for="name">{{ __('Name') }}</label>

			<div>
				<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

				@error('name')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
		</div>

		<div class="form-group">
			<label for="email">{{ __('E-Mail Address') }}</label>

			<div>
				<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
				<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

				@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
		</div>

		<div class="form-group">
			<label for="password-confirm">{{ __('Confirm Password') }}</label>

			<div>
				<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
			</div>
		</div>

		<div class="form-group">
			<div>
				<button type="submit" class="btn btn-primary">
					{{ __('Register') }}
				</button>
			</div>
		</div>
	</form>
</div>
@endsection
