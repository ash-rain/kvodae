@extends('layout')

@section('title', $template->name)

@section('content')
<h1>{{ $template->name }}</h1>

<div class="medium-6 columns">
	<div class="th">
	@include('image.show', ['image' => $template->images[0]])
	</div>
</div>

<div class="medium-6 columns">
	<h2>
		{{ $template->price }}
		{{ config('app.currency') }}
	</h2>
	<a class="button" href="{{ action('ProductController@create', ['template' => $template->id]) }}">{{ trans('template.customize') }}</a>
</div>

<div class="small-12 columns">
	<h2>{{ trans('template.products') }}</h2>
</div>

@stop