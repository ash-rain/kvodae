@extends('layout')

@section('title', trans('template.edit'))

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
var text = "{{ trans('template.sample_text') }}"

@stop

@section('content')

{!! Form::model($template, [ 'url' => action('TemplateController@update', $template->id), 'method' => 'patch' ]) !!}

<ul class="small-block-grid-3">
	<li>
		<label>
			{{ trans('app.name') }}
			{!! Form::text('name', null, ['required']) !!}
		</label>
	</li>
	<li>
		<label>
			{{ trans('app.price') }}
			{!! Form::text('price', null, ['required']) !!}
		</label>
	</li>
	<li>
		<label>
			{{ trans('template.preview_text') }}
			{!! Form::text('text', trans('template.sample_text')) !!}
		</label>
	</li>
</ul>

<div class="row">
	<div class="medium-4 columns">
		<button type="submit" class="full">{{ trans('app.save') }}</button>
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
	<div class="medium-4 columns">
		<div class="panel">
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
					<div class="row collapse">
						<div class="small-6 columns">
							<label>
								{{ trans('template.font_size') }}
								<input type="number" name="font_size" min="10"
									value="{{ $template->drawConfig->font_size or 72 }}" />
							</label>
						</div>
						<div class="small-6 columns">
							<label>
								<span class="right">{{ trans('template.align') }}</span>
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
						{{ trans('template.font_color') }}
						<input type="text" name="fill"
							value="{{ $template->drawConfig->fill or '#000000' }}" />
					</label>
				</li>
			</div>

			<label>
				{{ trans('template.rotation') }}
				<input type="range" class="full" name="rotate" min="-180" max="180"
					value="{{ $template->drawConfig->rotate or 0 }}" />
			</label>
		</div>
		{!! Form::hidden('draw_data') !!}
	</div>

	<div class="medium-8 columns">

		<div class="th full">
			<canvas style="width: 100%;"></canvas>
			<div id="image">
				@include('image.show', ['image' => count($template->images) ? $template->images[0] : null])
			</div>
			<div id="image"></div>
		</div>
	</div>
</div>

{!! Form::close() !!}
@stop