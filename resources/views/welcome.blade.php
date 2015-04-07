@extends('layout')

@section('scripts')
<script type="text/javascript" src="{{ asset('js/view/buy.js') }}"></script>
@stop

@section('js')
var token = "{{ csrf_token() }}"
@stop

@section('content')

<div class="row">
	
	<div class="medium-8 columns">

		<div class="welcome framed-white text-center" style="margin: 39px 0;">
			<i class="fa fa-warning"></i>
			The site is still under development.
		</div>

		<div class="welcome framed-white text-center">
			<p>{!! nl2br(trans('welcome.intro')) !!}</p>
			
			<a class="framed button" href="{{ action('Auth\AuthController@getIndex') }}">
				<i class="fa fa-fw fa-sign-in"></i>
				{{ trans('app.login') }}
			</a>
		</div>

		<div class="welcome framed-white text-center">
			<h3>{{ trans('welcome.we_offer') }}</h3>

			<div class="row">
				<div class="small-4 columns">
					<i class="fa fa-4x fa-cogs"></i>
					<div>{{ trans('welcome.manufacture') }}</div>
				</div>
				<div class="small-4 columns">
					<i class="fa fa-4x fa-money"></i>
					<div>{{ trans('welcome.payment_processing') }}</div>
				</div>
				<div class="small-4 columns">
					<i class="fa fa-4x fa-truck"></i>
					<div>{{ trans('welcome.delivery') }}</div>
				</div>
			</div>

			<hr />
			<h3>{{ trans('welcome.getting_started') }}</h3>

			<div class="row">
				<div class="small-4 columns">
					<a href="{{ action('TemplateController@index') }}">
						<i class="fa fa-4x fa-eye"></i>
						<div>{{ trans('welcome.step_1') }}</div>
					</a>
				</div>
				<div class="small-4 columns">
					<i class="fa fa-4x fa-tags"></i>
					<div>{{ trans('welcome.step_2') }}</div>
				</div>
				<div class="small-4 columns">
					<i class="fa fa-4x fa-share-alt"></i>
					<div>{{ trans('welcome.step_3') }}</div>
				</div>
			</div>
		</div>
	
	</div>
	<div class="medium-4 columns">

		<h1>{{ trans('product.latest') }}</h1>

		<ul class="small-block-grid-2 medium-block-grid-1">
		@foreach($latest as $product)
			<li>@include('product.tile')</li>
		@endforeach
		</ul>
	
	</div>
</div>

@stop