@extends('layout')

@section('title', trans('template.edit'))

@include('shared.number')

@section('head')
<link rel="stylesheet" href="{{ asset('css/jquery.minicolors.css') }}" />
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.minicolors.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/paper.js/0.9.22/paper-core.min.js"></script>
<script type="text/javascript" src="{{ asset('js/view/template.edit.js') }}"></script>
@stop

@section('js')
var drawConfig = {!! $template->draw_data !!}
var text = "{{ trans('template.sample_text') }}"

@stop

@section('content')

{!! Form::model($template, [ 'url' => action('TemplateController@update', $template->id), 'method' => 'patch' ]) !!}

<div class="row">
	<div class="large-4 columns">
		<a class="submit button framed full">
			<i class="fa fa-check"></i>
			{{ trans('app.save') }}
		</a>
	</div>
	<div class="large-8 columns">
		<p class="framed image-upload {{ count($template->images) ? '' : 'new' }}"
		 	data-id="{{ $template->id }}"
			data-submit="{{ !count($template->images)
			? action('ImageController@store')
			: action('ImageController@update', $template->images[0]->id) }}">
			<a class="button full">
				<i class="fa fa-image"></i>
				@if(count($template->images))
				{{ trans('template.photo_change') }}
				@else
				{{ trans('template.photo_upload') }}
				@endif
			</a>
			<input type="file" />
		</p>
	</div>
</div>

<div class="row">
	<div class="large-4 columns">
		<div class="form framed-white">
			<ul class="tabs small-block-grid-2" data-tab>
				<li class="tab-title active">
					<a href="#panel1">
					<i class="fa fa-2x fa-eye"></i>
					</a>
				</li>
				<li class="tab-title">
					<a href="#panel2">
						<i class="fa fa-2x fa-edit"></i>
					</a>
				</li>
			</ul>
			<hr />
			<div class="tabs-content">
				<div class="content active" id="panel1">
					<label>
						{!! Form::checkbox('multiline') !!}
						{{ trans('template.allow_multiline') }}
					</label>

					<label>
						{{ trans('template.font') }}
						<select name="font_family">
							@foreach($fonts as $font)
							<option {{ @$template->drawConfig->font_family == $font ? 'selected' : '' }}>
								{{ $font }}
							</option>
							@endforeach
						</select>
					</label>
					
					<div class="medium-block-grid-2">
						<li>
							<label>
								{{ trans('template.font_size') }}
								<input type="number" name="font_size" min="10"
									value="{{ $template->drawConfig->font_size or 72 }}" />
							</label>
						</li>
						<li>
							<label>
								{{ trans('template.font_color') }}
								<input type="text" name="fill"
									value="{{ $template->drawConfig->fill or '#000000' }}" />
							</label>
						</li>
					</div>

					<div>
						{{ trans('template.rotation') }}
						<div id="rotate" class="framed-white range-slider" data-slider
							data-options="start: -90; end: 90; initial: {{ $template->drawConfig->rotate or 0 }};">
							<span class="range-slider-handle" role="slider" tabindex="0"></span>
							<span class="range-slider-active-segment"></span>
						</div>
					</div>

					<div>
						{{ trans('template.skew') }}
						<div id="skew" class="framed-white range-slider" data-slider
							data-options="start: -40; end: 40; initial: {{ $template->drawConfig->skewX or 0 }};">
							<span class="range-slider-handle" role="slider" tabindex="0"></span>
							<span class="range-slider-active-segment"></span>
						</div>
					</div>
					{!! Form::hidden('draw_data') !!}
				</div>
				<div class="content" id="panel2">
					<div>
						<label>
							{{ trans('app.name') }}
							{!! Form::text('name', null, ['required', 'style' => 'font-weight: 700']) !!}
						</label>
					</div>
					<div>
						<label>
							{{ trans('app.price') }}
							{!! Form::text('price', null, ['required']) !!}
						</label>
					</div>
					<div>
						<label>
							{{ trans('template.preview_text') }}
							{!! Form::text('text', trans('template.sample_text')) !!}
						</label>
					</div>
					<div>
						<label>
							{{ trans('template.vendor') }}
							{!! Form::select('vendor_id', $vendors) !!}
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="large-8 columns">
		<div class="framed-white" style="background: #fff;">
			<canvas></canvas>
			<div id="image">
				@include('image.show', ['image' => count($template->images) ? $template->images[0] : null, 'original' => true])
			</div>
		</div>
	</div>
</div>

{!! Form::close() !!}
@stop