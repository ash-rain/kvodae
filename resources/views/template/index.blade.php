@extends('layout')

@section('title', 'Templates')

@section('content')

<a class="button" href="{{ action('TemplateController@create') }}">
	{{ trans('Create') }}
</a>

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