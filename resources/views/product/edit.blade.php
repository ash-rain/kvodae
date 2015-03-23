@extends('layout')

@section('title', $product->name)

@include('shared.number')

@section('scripts')
<script type="text/javascript" src="{{ asset('js/paper-core.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/view/product.edit.js') }}"></script>
@stop

@section('js')
var drawConfig = {!! $product->template->draw_data !!}
var productId = {{ $product->id }}
var postUrl = "{{ count($product->images)
	? action('ImageController@update', $product->images[0]->id)
	: action('ImageController@store') }}"
@stop

@section('content')

{!! Form::model($product, [ 'url' => action('ProductController@update', $product->id), 'method' => 'patch' ]) !!}

<input type="hidden" name="template_id" value="{{ $product->template_id }}" />

<div class="row">
	<div class="medium-4 columns">
		<button type="submit" class="full" style="margin: 7px 0 0 0">
			{{ trans('app.save') }}
		</button>
	</div>
	<div class="medium-4 columns">
		<label>
			{{ trans('app.name') }}
			{!! Form::text('name', null, ['required']) !!}
		</label>
	</div>
	<div class="medium-4 columns">
		<label>
			{{ trans('app.price') }}

			<div class="row collapse">
				<div class="small-3 columns">
					<span class="prefix">
						{{ $product->template->price }}
						<i class="fa fa-plus"></i>
					</span>
				</div>
				<div class="small-9 columns">
					{!! Form::text('price', null, ['required', 'type' => 'number']) !!}
				</div>
			</div>
		</label>
	</div>
</div>

<div class="row">
	<div class="medium-12 columns">
		@if($product->template->multiline)
		{!! Form::textarea('text', null, ['required', 'rows' => 4]) !!}
		@else
		{!! Form::text('text', null, ['required']) !!}
		@endif
	</div>
</div>

<div class="row">
	<div class="small-12 columns">
		<p class="th" style="display: block;">
			<canvas style="width: 100%;"></canvas>
			<div id="image" class="{{ count($product->images) ? '' : 'new' }}">
				@include('image.show', ['image' => $product->template->images[0]])
			</div>
		</p>
	</div>
</div>

{!! Form::close() !!}

@stop