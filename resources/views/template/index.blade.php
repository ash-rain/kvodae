@extends('layout')

@section('title', trans('template.index'))

@section('content')

<h1>
	{{ trans('template.index') }}
	<a class="button" href="{{ action('TemplateController@create') }}">
		<i class="fa fa-plus"></i>
		{{ trans('app.create') }}
	</a>
</h1>

<ul class="small-block-grid-2 medium-block-grid-4">
@foreach($templates as $template)
	<li>
		<a href="{{ action('TemplateController@show', $template->id) }}">
			@if(count($template->images))
			<div class="th">
				@include('image.show', array('image' => $template->images[0]))
			</div>
			@endif
			<h4>{{ $template->name }}</h4>
		</a>
	</li>
@endforeach
</ul>

@stop