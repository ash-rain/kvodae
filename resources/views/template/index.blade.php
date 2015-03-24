@extends('layout')

@section('title', trans('template.index'))

@section('content')

<h1>
	{{ trans('template.index') }}
	<a class="button right" href="{{ action('TemplateController@create') }}">
		<i class="fa fa-plus"></i>
		{{ trans('app.create') }}
	</a>
</h1>

<ul class="medium-block-grid-4">
@foreach($templates as $template)
	<li>
		<a href="{{ action('TemplateController@show', $template->id) }}">
			<div >
				{{ $template->price .' '. config('app.currency') }}
			</div>
			<h4>{{ $template->name }}</h4>
			@if(count($template->images))
			<div class="th">
				@include('image.show', array('image' => $template->images[0]))
			</div>
			@endif
		</a>
	</li>
@endforeach
</ul>

@stop