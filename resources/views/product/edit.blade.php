@extends('layout')

@section('title', 'Edit Product')

@include('shared.number')

@section('js')
var drawConfig = {!! $product->template->draw_data !!}
var canvas = $("canvas")[0]

$("#image img").load(function(){
	$("#image").hide()
	drawText()
})

$("input[name='text']")
	.keyup(drawText)

$("form").submit(function(e) {
	e.preventDefault()
	e.returnValue = false

	var data = canvas.toDataURL()
	var form = $(this)

	$.ajax({
		type: "post",
		url: "{{ action('ImageController@store') }}",
		data: { "data": data, "imageable_id": {{ $product->id }}, "_token": "{{ csrf_token() }}" },
		context: form,
		complete: function() {
			this.unbind("submit");
			this.submit()
		}
	})
	return false
})

function drawText() {
	var text = $("input[name='text']").val()
	var context = canvas.getContext("2d")
	context.save()
	context.clearRect(0 , 0 , canvas.width, canvas.height)
	context.drawImage($("#image img")[0] , 0, 0, canvas.width, canvas.height)
	context.translate(drawConfig.x || 0, drawConfig.y || 10)
	context.rotate( -Math.PI * drawConfig.rotate )
	context.font = (drawConfig.font_size || 14) + "px " + (drawConfig.font || "sans-serif")
	context.fontWeight = 700
	context.fillStyle = drawConfig.fill || "#000000"
	context.textAlign = drawConfig.align || "left"
	context.fillText(text, 0, 0)
	context.restore()
}
@parent
@stop

@section('content')

{!! Form::model($product, [ 'url' => action('ProductController@update', $product->id), 'method' => 'patch' ]) !!}

<input type="hidden" name="template_id" value="{{ $product->template_id }}" />

<div class="medium-6 columns">
	<label>
		{{ trans('Name') }}
		{!! Form::text('name', null, ['required']) !!}
	</label>

	<label>
		{{ trans('Price') }}

		<div class="row collapse">
			<div class="small-3 large-2 columns">
				<span class="prefix">
					{{ $product->template->price }}
					<i class="fa fa-plus"></i>
				</span>
			</div>
			<div class="small-9 large-10 columns">
				{!! Form::text('price', null, ['required', 'type' => 'number']) !!}
			</div>
		</div>
	</label>

	<label>
		{{ trans('Text') }}
		{!! Form::text('text', null, ['required']) !!}
	</label>

	<button type="submit">{{ trans('Save') }}</button>

</div>

<div class="medium-6 columns">

	<div class="th" style="display: block;">
		<canvas style="width: 100%;"></canvas>
	</div>

	<div id="image">
		@include('image.show', ['image' => $product->template->images[0]])
	</div>

</div>

{!! Form::close() !!}

@stop