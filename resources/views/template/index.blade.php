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

<ul class="small-block-grid-2 medium-block-grid-4">
@foreach($templates as $template)
	<li>
		<a href="{{ action('TemplateController@show', $template->id) }}">
		<div class="product th"
			style="background-image: url(/images/{{ $template->images[0]->id }})">
			<div class="info row collapse trans-opacity">
				<div class="small-12 columns">
					<h4>{{ $template->name }}</h4>
					<div>{{ $template->price .' '. config('app.currency') }}</div>
				</div>
			</div>
		</div>
		</a>
	</li>
@endforeach
</ul>

@stop