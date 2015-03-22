@extends('layout')

@section('title', 'Create Product')

@include('shared.number')

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

		<div class="row collapse">
			<div class="small-3 large-2 columns">
				<span class="prefix">
					{{ $template->price }}
					<i class="fa fa-plus"></i>
				</span>
			</div>
			<div class="small-9 large-10 columns">
				<input type="number" name="price" value="{{ old('price') }}" />
			</div>
		</div>
	</label>

	<label>
		<input type="checkbox" checked />
		{{ trans('For Sale') }}
	</label>
	
	<button type="submit">{{ trans('Create') }}</button>
</div>
<div class="medium-6 columns">
	@include('image.show', ['image' => $template->images[0]])
</div>

{!! Form::close() !!}

@stop