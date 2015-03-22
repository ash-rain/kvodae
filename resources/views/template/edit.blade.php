@extends('layout')

@section('title', 'Edit Template')

@include('shared.number')

@section('head')
<link rel="stylesheet" href="{{ asset('css/jquery.minicolors.css') }}" />
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.minicolors.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/paper-core.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/view/template.edit.js') }}"></script>
@stop

@section('js')
var drawConfig = {!! $template->draw_data !!}
var text = "{{ trans('Sample Text') }}"

@stop

@section('content')

{!! Form::model($template, [ 'url' => action('TemplateController@update', $template->id), 'method' => 'patch' ]) !!}

<div class="medium-4 columns">
	<button type="submit" class="full">{{ trans('Save') }}</button>

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
		{!! Form::text('text', trans('Sample Text')) !!}
	</label>

	<label>
		{!! Form::checkbox('multiline') !!}
		{{ trans('Allow Multiline') }}
	</label>

	<div class="panel">
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
		
		<div class="medium-block-grid-2">
			<li>
				<div class="row collapse">
					<div class="small-6 columns">
						<label>
							{{ trans('Size') }}
							<input type="number" name="font_size" min="10"
								value="{{ $template->drawConfig->font_size or 14 }}" />
						</label>
					</div>
					<div class="small-6 columns">
						<label>
							<span class="right">{{ trans('Align') }}</span>
							<select name="align" class="fa">
								@foreach(['left', 'center', 'right'] as $i => $align)
								<option value="{{ $align }}"
									{{ (isset($template->drawConfig->align) ? $template->drawConfig->align : 'center') == $align ? 'selected' : '' }}>&#xf03{{ 6 + $i }};
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
		</div>

		<label>
			{{ trans('Rotation') }}
			<input type="range" class="full" name="rotate" min="-180" max="180"
				value="{{ $template->drawConfig->rotate or 0 }}" />
		</label>
	</div>
	{!! Form::hidden('draw_data') !!}
</div>

<div class="medium-8 columns">
	<p class="image-upload {{ count($template->images) ? '' : 'new' }}"
	 	data-id="{{ $template->id }}"
		data-submit="{{ !count($template->images)
		? action('ImageController@store')
		: action('ImageController@update', $template->images[0]->id) }}">
		<a class="button full">
			<i class="fa fa-image"></i>
			@if(count($template->images))
			{{ trans('Change Photo') }}
			@else
			{{ trans('Upload Photo') }}
			@endif
		</a>
		<input type="file" />
	</p>

	<div class="th full">
		<canvas style="width: 100%;"></canvas>
		<div id="image">
			@include('image.show', ['image' => count($template->images) ? $template->images[0] : null])
		</div>
		<div id="image"></div>
	</div>
</div>

{!! Form::close() !!}
@stop