@extends('layout')

@section('title', $template->name)

@section('content')

@if(count($template->images))
<div class="medium-6 columns">
	<div class="th">
	@include('image.show', ['image' => $template->images[0]])
	</div>
</div>
<div class="medium-6 columns">
@endif

<h2>{{ $template->price }}</h2>

<a class="button" href="{{ action('ProductController@create', ['template' => $template->id]) }}">{{ trans('Customize') }}</a>

@if(count($template->images))
</div>
@endif

@stop