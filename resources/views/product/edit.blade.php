@extends('layout')

@section('title', 'Edit Product')

@include('shared.price')

@section('js')
var drawConfig = {!! $product->template->draw_data !!}
var canvas = $("canvas")[0]

$("#image").hide()
drawText()

$("input[name='text']")
	.keyup(drawText)
	.change(function() {
		var data = canvas.toDataURL()
		$.post("{{ action('ImageController@store') }}", {
			"data": data,
			"imageable_id": {{ $product->id }},
			"_token": "{{ csrf_token() }}"
		})
	})

function drawText() {
	var text = $("input[name='text']").val()
	var context = canvas.getContext("2d")
	context.save()
	context.clearRect(0 , 0 , canvas.width, canvas.height)
	context.drawImage($("#image img")[0] , 0, 0, canvas.width, canvas.height)
	context.translate(drawConfig.x || 0, drawConfig.y || 10)
	context.rotate( -Math.PI * drawConfig.rotate )
	context.font = drawConfig.font || "16px sans-serif"
	context.fontWeight = 700
	context.fillStyle = drawConfig.fill || "#000000"
	context.textAlign = drawConfig.align || "left"
	context.fillText(text, 0, 0)
	context.restore()
}
@parent
@stop

@section('content')

{!! Form::model($product, [ 'url' => action('ProductController@update'), 'method' => 'patch' ]) !!}

<input type="hidden" name="template_id" value="{{ $product->template_id }}" />

<div class="medium-6 columns">
	<label>
		{{ trans('Name') }}
		{!! Form::text('name', null, ['required']) !!}
	</label>

	<label>
		{{ trans('Price') }}
		{!! Form::text('price', null, ['required']) !!}
	</label>

	<label>
		{{ trans('Text') }}
		{!! Form::text('text', null, ['required']) !!}
	</label>

	<button type="submit">{{ trans('Save') }}</button>

</div>

<div class="medium-6 columns">

	<canvas style="width: 100%; height: auto;"></canvas>

	<div id="image">
		@include('image.show', ['image' => $product->template->images[0]])
	</div>

</div>

{!! Form::close() !!}

@stop