@extends('layout')

@section('title', trans('template.create'))

@include('shared.number')

@section('content')

{!! Form::open([ 'url' => action('TemplateController@store') ]) !!}

<div class="medium-6 medium-centered columns">
	<h1>{{ trans('template.create') }}</h1>

	<label>
		{{ trans('app.name') }}
		<input type="text" name="name" value="{{ old('name') }}" required />
	</label>

	<label>
		{{ trans('app.price') }}
		<input type="number" name="price" value="{{ old('price') }}" required />
	</label>

	<button type="submit">{{ trans('app.create') }}</button>
</div>

{!! Form::close() !!}

@stop