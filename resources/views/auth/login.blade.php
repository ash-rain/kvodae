@extends('layout')

@section('title', 'Login')

@section('content')
<div class="medium-6 medium-centered columns">
	
	@if (count($errors) > 0)
		@foreach ($errors->all() as $error)
			<div class="alert-box alert" data-alert>{{ trans($error) }}</div>
		@endforeach
	@endif

	<p>
		<a href="{{ action('Auth\AuthController@getRegister') }}">
			{{ trans('Don\'t have an account?') }}
		</a>
	</p>

	<form role="form" method="POST" action="{{ url('/auth/login') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<label>
			{{ trans('E-Mail Address') }}
			<input type="email" name="email" value="{{ old('email') }}" />
		</label>

		<label>
			{{ trans('Password') }}
			<input type="password" name="password" />
		</label>

		<label>
			<input type="checkbox" name="remember">
			{{ trans('Remember Me') }}
		</label>

		<button type="submit">{{ trans('Login') }}</button>
		<a class="right" href="{{ url('/password/email') }}">
			{{ trans('Forgot Your Password?') }}
		</a>
	</form>
</div>
@endsection
