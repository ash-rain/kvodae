@extends('layout')

@section('title', $product->name)

@include('shared.number')

@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/paper.js/0.9.22/paper-core.min.js"></script>
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
		<div class="row">
			<div class="small-8 columns">
				<a class="submit button full framed">
					<i class="fa fa-check"></i>
					{{ trans('app.save') }}
				</a>
			</div>
			<div class="small-4 columns">
				<a class="submit button full"
					href="{{ action('ProductController@show', $product->id) }}">
					<i class="fa fa-eye"></i>
				</a>
			</div>
		</div>
		<div class="form">
			<div>
				@if($product->template->multiline)
				{!! Form::textarea('text', null, ['required', 'rows' => 4]) !!}
				@else
				{!! Form::text('text', !empty($product->text) ? $product->text : $product->name, ['required']) !!}
				@endif
			</div>

			<div>
				<label>
					{{ trans('app.name') }}
					{!! Form::text('name', null, ['required']) !!}
				</label>
			</div>

			<div>
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

			<div>
				<label>
					{{ trans('product.description') }}
					{!! Form::textarea('description') !!}
				</label>
			</div>
		</div>
	</div>

	<div class="medium-8 columns">
		<div id="image" class="{{ count($product->images) ? '' : 'new' }}">
			@include('image.show', ['image' => $product->template->images[0], 'original' => true])
		</div>
		<canvas></canvas>
	</div>

</div>

{!! Form::close() !!}

@stop