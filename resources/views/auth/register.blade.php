@extends('layout')

@section('title', 'Register')

@section('content')
<div class="medium-6 medium-centered columns">

	@if (count($errors) > 0)
		@foreach ($errors->all() as $error)
			<div class="alert-box alert" data-alert>{{ $error }}</div>
		@endforeach
	@endif

	<form role="form" method="POST" action="{{ url('/auth/register') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<label>
			{{ trans('Name') }}
			<input type="text" name="name" value="{{ old('name') }}">
		</label>

		<label>
			{{ trans('E-Mail Address') }}
			<input type="email" name="email" value="{{ old('email') }}">
		</label>

		<label>
			{{ trans('Password') }}
			<input type="password" name="password">
		</label>

		<label>
			{{ trans('Confirm Password') }}
			<input type="password" name="password_confirmation">
		</label>

		<button type="submit">
			{{ trans('Register') }}
		</button>
	</form>
</div>
@endsection
