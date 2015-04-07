@extends('layout')

@section('content')

{!! Form::model($user, ['url' => action('UserController@update')]) !!}
<h1>
	<a class="submit button framed right">
		<i class="fa fa-check"></i>
		{{ trans('app.save') }}
	</a>
	<a class="button framed right"
		href="{{ action('Auth\AuthController@getLogout') }}">
		<i class="fa fa-sign-out"></i>
		{{ trans('app.logout') }}
	</a>
	{{ $user->name }}
</h1>

<div class="form framed-white">
	{!! Form::label('name') !!}
	{!! Form::text('name') !!}

	{!! Form::label('email') !!}
	{!! Form::text('email') !!}

	{!! Form::label('subdomain') !!}
	<div class="row collapse">
		<div class="small-8 columns">
			{!! Form::text('subdomain') !!}
		</div>
		<div class="small-4 columns">
			<span class="postfix">.microbrander.com</span>
		</div>
      </div>
</div>

{!! Form::close() !!}

@stop