@extends('layout')

@section('title', 'Edit Template')

@include('shared.price')

@section('content')

{!! Form::model($template, [ 'url' => action('TemplateController@update', $template->id), 'method' => 'patch' ]) !!}

<div class="medium-4 columns">
	<label>
		{{ trans('Name') }}
		{!! Form::text('name', null, ['required']) !!}
	</label>

	<label>
		{{ trans('Price') }}
		{!! Form::text('price', null, ['required']) !!}
	</label>

	<div class="small-block-grid-2">
		<li>
			<label>
				{{ trans('Font') }}
				<select name="font_family">
					<option>serif</option>
					<option>sans-serif</option>
				</select>
			</label>
		</li>
		<li>
			<label>
				{{ trans('Font Size') }}
				<input type="number" name="font_size" min="8" max="72" />
			</label>
		</li>
		<li>
			<label>
				{{ trans('Color') }}
				<input type="text" name="font_color" value="{{ $template->drawConfig->color or '#000000' }}" />
			</label>
		</li>
		<li>			
			<label>
				{{ trans('Rotation') }}
				<input type="range" name="rotate" min="-1" max="1" step="0.1" value="{{ $template->drawConfig->rotate or 0 }}" />
			</label>
		</li>
		<li>
			<label>
				{{ trans('X Offset') }}
				<input type="number" name="x" value="{{ $template->drawConfig->x or 0 }}" />
			</label>
		</li>
		<li>
			<label>
				{{ trans('Y Offset') }}
				<input type="number" name="y" value="{{ $template->drawConfig->y or 10 }}" />
			</label>
		</li>
	</div>
	<button type="submit">{{ trans('Save') }}</button>
</div>

<div class="medium-8 columns">
	<div class="th image-upload {{ !count($template->images) ? 'new' : '' }}"
		data-submit="{{ !count($template->images) ? action('ImageController@store') : action('ImageController@update', $template->images[0]->id) }}"
		data-id="{{ $template->id }}">
		<div class="th">
			<canvas style="width: {{ $template->images[0]->width }}px; height: {{ $template->images[0]->height }}px;"></canvas>
			<div id="image">
				@if(count($template->images))
				@include('image.show', ['image' => $template->images[0]])
				@endif
			</div>
		</div>
		<a class="button full">
			<i class="fa fa-image"></i>
			@if(count($template->images))
			{{ trans('Change Photo') }}
			@else
			{{ trans('Upload Photo') }}
			@endif
		</a>
		<input type="file" />
	</div>
</div>

{!! Form::close() !!}
@stop

@section('head')
<link rel="stylesheet" href="{{ asset('css/jquery.minicolors.css') }}" />
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.minicolors.js') }}"></script>
@stop

@section('js')
var drawConfig = {!! $template->draw_data !!}
var canvas = $("canvas")[0]
var text = "{{ trans('Sample Text') }}"

$("#image").hide()
drawText()

$("select[name='font_family']").change(function(){
	drawConfig.font = $("input[name='font_size']").val() + "px " + $(this).val()
	drawText()
})
$("input[name='font_size']").change(function(){
	drawConfig.font = $(this).val() + "px " + $("select[name='font_family']").val()
	drawText()
})

function drawText() {
	var context = canvas.getContext("2d")
	console.log(drawConfig)
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

$("input[name='font_color']").minicolors({ position: "top left" })

$(".image-upload").each(function() {
	var me = $(this)
	$(this).find("input[type='file']").change(function(event) {
		var files = event.target.files
        	
        	var data = new FormData();
        	data.append("file", files[0])
		data.append("imageable_id", me.data("id"))
		data.append("imageable", "template")
		if(!me.is(".new")) data.append("_method", "PATCH");
		data.append("_token", "{{ csrf_token() }}")

		$.ajax({
			url: me.data("submit"),
			type: "POST",
			data: data,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data) {
				me.find("#image").html(data)
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.error(textStatus);
			}
		});
	});
})
@stop