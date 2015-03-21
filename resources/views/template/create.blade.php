@extends('layout')

@section('title', 'Create Template')

@include('shared.number')

@section('content')

{!! Form::open([ 'url' => action('TemplateController@store') ]) !!}

<div class="medium-6 medium-centered columns">
	<label>
		{{ trans('Name') }}
		<input type="text" name="name" value="{{ old('name') }}" required />
	</label>

	<label>
		{{ trans('Price') }}
		<input type="number" name="price" value="{{ old('price') }}" required />
	</label>

	<button type="submit">{{ trans('Create') }}</button>
</div>

{!! Form::close() !!}

@stop