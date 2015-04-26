@extends('layout')

@section('title', $template->name)

@section('content')

<div class="medium-6 columns">
	<div class="th framed">
	@include('image.show', ['image' => $template->images[0]])
	</div>
</div>

<div class="medium-6 columns">
	<a class="framed full button"
		href="{{ action('ProductController@create', ['template' => $template->id]) }}">
		<i class="fa fa-2x fa-fw fa-lightbulb-o"></i>
		{{ trans('template.customize') }}
	</a>
	
	@if(Auth::user()->isAdmin)
	<div class="row collapse">
		<div class="small-6 columns">
			<a class="full button"
				href="{{ action('TemplateController@edit', $template->id) }}">
				<i class="fa fa-2x fa-fw fa-pencil"></i>
				{{ trans('app.edit') }}
			</a>
		</div>
		<div class="small-6 columns">
			<a class="full button"
				href="{{ action('TemplateController@destroy', $template->id) }}">
				<i class="fa fa-2x fa-fw fa-remove"></i>
				{{ trans('app.delete') }}
			</a>
		</div>
	</div>
	@endif

	<h1>{{ $template->name }}</h1>
	
	<h2>
		{{ $template->price }}
		{{ config('app.currency') }}
	</h2>

	@if($template->specs)
	<div class="form">
		<table class="full specs" cellspacing="0">
			@foreach($template->specs as $key => $value)
			<tr>
				<td class="key" width="20">{{ trans('specs.' . $key) }}</td>
				<td class="text-right">{{ $value }}</td>
			</tr>
			@endforeach
		</table>
	</div>
	@endif
</div>

@if(count($template->products))
<div class="small-12 columns">
	<h2>{{ trans('template.products') }}</h2>
	<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3"> 
	@foreach($template->products()->limit(6)->get() as $product)
		<li>@include('product.tile')</li>
	@endforeach
	</ul>
</div>
@endif

@stop