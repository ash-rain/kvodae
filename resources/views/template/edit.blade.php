@extends('layout')

@section('title', 'Edit Template')

@include('shared.number')

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

	<label>
		{{ trans('Preview Text') }}
		{!! Form::text('text') !!}
	</label>

	<div class="small-block-grid-2">
		<li>
			<label>
				{{ trans('Font') }}
				<select name="font_family">
					@foreach($fonts as $font)
					<option {{ @$template->drawConfig->font_family == $font ? 'selected' : '' }}>
						{{ $font }}
					</option>
					@endforeach
				</select>
			</label>
		</li>
		<li>
			<div class="row collapse">
				<div class="medium-8 columns">
					<label>
						{{ trans('Size') }}
						<input type="number" name="font_size" min="8" max="72"
							value="{{ $template->drawConfig->font_size or 14 }}" />
					</label>
				</div>
				<div class="medium-4 columns">
					<label>
						<span class="right">{{ trans('Align') }}</span>
						<select name="align" class="fa">
							@foreach(['left', 'center', 'right'] as $i => $align)
							<option value="{{ $align }}"
								{{ @$template->drawConfig->align == $align ? 'selected' : '' }}>&#xf03{{ 6 + $i }};
								<i class="fa fa-align-{{ $align }}"></i>
							</option>
							@endforeach
						</select>
					</label>
				</div>
		</li>
		<li>
			<label>
				{{ trans('Color') }}
				<input type="text" name="fill"
					value="{{ $template->drawConfig->fill or '#000000' }}" />
			</label>
		</li>
		<li>			
			<label>
				{{ trans('Rotation') }}
				<input type="range" name="rotate" min="-1" max="1" step="0.1"
					value="{{ $template->drawConfig->rotate or 0 }}" />
			</label>
		</li>
		<li>
			<label>
				{{ trans('X Offset') }}
				<input type="number" name="x" step="10"
					value="{{ $template->drawConfig->x or 0 }}" />
			</label>
		</li>
		<li>
			<label>
				{{ trans('Y Offset') }}
				<input type="number" name="y" step="10"
					value="{{ $template->drawConfig->y or 10 }}" />
			</label>
		</li>
	</div>
	{!! Form::hidden('draw_data') !!}
	<button type="submit">{{ trans('Save') }}</button>
</div>

<div class="medium-8 columns">
	<div class="th image-upload {{ !count($template->images) ? 'new' : '' }}"
		data-submit="{{ !count($template->images) ? action('ImageController@store') : action('ImageController@update', $template->images[0]->id) }}"
		data-id="{{ $template->id }}" style="width: 100%;">
		
		@if(count($template->images))
		<canvas style="width: 100%; height: {{ $template->images[0]->height }}px;"></canvas>
		<div id="image">
		@include('image.show', ['image' => $template->images[0]])
		</div>
		
		@else
		<div id="image"></div>
		@endif

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

$("form").submit(function(){
	$("input[name='draw_data']").val(JSON.stringify(drawConfig))
	console.log($("input[name='draw_data']").val())
})

$("input[name='text']").bind("keyup change", function() {
	text = $(this).val()
	drawText()
})
$("select[name='font']").bind("keyup change", function() {
	drawConfig.font = $(this).val()
	drawText()
})
$("input[name='font_size']").bind("keyup change", function() {
	drawConfig.font_size = $(this).val()
	drawText()
})
$("input[name='align']").change(function() {
	drawConfig.align = $(this).val()
	drawText()
})
$("input[name='fill']").minicolors({
	position: "top left",
	change: function(hex) {
		drawConfig.fill = hex
		drawText()
	}
})
$("input[name='rotate']").mousedown(function() {
	$(this).mousemove(function() {
		drawConfig.rotate = $(this).val()
		drawText()
	}).mouseup(function() {
		$(this).unbind("mousemove")
	})
}).change(function() {
	drawConfig.rotate = $(this).val()
	drawText()
})
$("input[name='x']").bind("keyup change", function() {
	drawConfig.x = $(this).val()
	drawText()
})
$("input[name='y']").bind("keyup change", function() {
	drawConfig.y = $(this).val()
	drawText()
})

function drawText() {
	if(!canvas) return;
	var context = canvas.getContext("2d")
	context.save()
	
	var image = $("#image img")

	if(image.length) {
		$(canvas)
			.css("width", $(canvas).width() + "px")
			.css("height", Math.round(($(canvas).width() / image.width()) * image.height()) + "px")
	}

	context.clearRect(0 , 0 , canvas.width, canvas.height)

	if(image.length)
		context.drawImage(image[0] , 0, 0, canvas.width, canvas.height)
	
	context.translate(drawConfig.x || 0, drawConfig.y || 10)
	context.rotate( -Math.PI * drawConfig.rotate )
	context.font = (drawConfig.font_size || 14) + "px " + (drawConfig.font || "sans-serif")
	context.fontWeight = 700
	context.fillStyle = drawConfig.fill || "#000000"
	context.textAlign = drawConfig.align || "left"
	context.fillText(text, 0, 0)
	context.restore()
}

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
				$("#image").html(data)
				drawText()
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.error(textStatus);
			}
		});
	});
})
@stop