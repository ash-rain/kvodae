@extends('layout')

@section('title', trans('template.create'))

@include('shared.number')

@section('content')

{!! Form::open([ 'url' => action('TemplateController@store') ]) !!}

<div class="medium-6 medium-centered columns">
	<h1>{{ trans('template.create') }}</h1>
	
	<div class="form">
		<label>
			{{ trans('app.name') }}
			<input type="text" name="name" value="{{ old('name') }}" required />
		</label>

		<label>
			{{ trans('app.price') }}
			<input type="number" name="price" value="{{ old('price') }}" required />
		</label>
	</div>

	<a class="submit framed button full">{{ trans('app.create') }}</a>
</div>

{!! Form::close() !!}

@stop