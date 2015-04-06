@extends('layout')

@section('scripts')
<script type="text/javascript" src="{{ asset('js/view/buy.js') }}"></script>
@stop

@section('js')
var token = "{{ csrf_token() }}"
@stop

@section('content')

<div class="welcome framed-white text-center">
	<p>{!! nl2br(trans('app.welcome')) !!}</p>
	<a class="framed button" href="{{ action('Auth\AuthController@getIndex') }}">
		<i class="fa fa-fw fa-sign-in"></i>
		{{ trans('app.get_started') }}
	</a>
</div>

<h1>{{ trans('product.latest') }}</h1>

<ul class="small-block-grid-2 medium-block-grid-4">
@foreach($latest as $product)
	<li>@include('product.tile')</li>
@endforeach
</ul>

@stop