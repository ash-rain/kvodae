@extends('layout')

@section('title', trans('product.create'))

@include('shared.number')

@section('content')

{!! Form::open([ 'url' => action('ProductController@store'), 'method' => 'post' ]) !!}

<input type="hidden" name="template_id" value="{{ $template->id }}" />

<h1>{{ trans('product.create') }}</h1>

<div class="row form framed-white">
	<div class="medium-6 columns">
		<label>
			{{ trans('app.name') }}
			<input type="text" name="name" value="{{ old('name') }}" required />
		</label>

		<label>
			{{ trans('app.price') }}

			<div class="row collapse">
				<div class="small-3 large-2 columns">
					<span class="prefix">
						{{ $template->price }}
						{{ config('app.currency') }}
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
			{{ trans('product.for_sale') }}
		</label>
		
		<a class="submit button full framed" href="javascript:void(0)">
			{{ trans('app.create') }}
			<i class="fa fa-arrow-right"></i>
		</a>
	</div>

	<div class="medium-6 columns">
		<p class="framed-white"> 
		@include('image.show', ['image' => $template->images[0]])
		</p>
	</div>
</div>

{!! Form::close() !!}

@stop