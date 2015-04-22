@extends('layout')

@section('title', trans('template.index'))

@section('content')

<ul class="small-block-grid-2 medium-block-grid-4">
@foreach($templates as $template)
	<li>
		<a href="{{ action('TemplateController@show', $template->id) }}">
		<div class="product th framed"
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