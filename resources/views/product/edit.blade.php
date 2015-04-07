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

<div class="form framed-white">
	<div class="row">
		<div class="medium-4 columns">
			<a class="submit button full framed" style="margin: 7px 0 0 0">
				{{ trans('app.save') }}
			</a>
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
			{!! Form::text('text', !empty($product->text) ? $product->text : $product->name, ['required']) !!}
			@endif
		</div>
	</div>
</div>

<div class="row">
	<div class="small-12 columns">
		<div class="th framed-white" style="display: block;">
			<canvas style="width: 100%;"></canvas>
			<div id="image" class="{{ count($product->images) ? '' : 'new' }}">
				@include('image.show', ['image' => $product->template->images[0], 'original' => true])
			</div>
		</div>
		<p></p>
	</div>
</div>

<div class="row">
	<div class="small-12 columns">
		<label>
			{{ trans('product.description') }}
			{!! Form::textarea('description') !!}
		</label>
	</div>
</div>

{!! Form::close() !!}

@stop