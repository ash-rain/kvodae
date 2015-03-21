@extends('layout')

@section('title', 'Create Product')

@include('shared.price')

@section('content')

{!! Form::open([ 'url' => action('ProductController@store') ]) !!}

<input type="hidden" name="template_id" value="{{ $template->id }}" />

<div class="medium-6 columns">
	<label>
		{{ trans('Name') }}
		<input type="text" name="name" value="{{ old('name') }}" required />
	</label>

	<label>
		{{ trans('Price') }}
		<input type="text" name="price" value="{{ old('price') }}" required />
	</label>

	<label>
		{{ trans('Text') }}
		<input type="text" name="text" value="{{ old('text') }}" required />
	</label>

	<button type="submit">{{ trans('Create') }}</button>
</div>
<div class="medium-6 columns">
	@include('image.show', ['image' => $template->images[0]])
</div>

{!! Form::close() !!}

@stop