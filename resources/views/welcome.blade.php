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

		<div class="welcome framed text-center">
			<i class="fa fa-warning"></i>
			The site is still under development.
		</div>

		<div class="text-center">		
			<p style="margin: 3rem 0; line-height: 1.7;">{!! nl2br(trans('welcome.intro')) !!}</p>
			
		</div>

		<ul class="small-block-grid-2">
			<li>
				<ul class="pricing-table">
					<li class="title">Free</li>
					<li class="price">0€</li>
					<li class="description">The best choice for small campaigns</li>
					<li class="bullet-item">Set Custom Price</li>
					<li class="bullet-item">10% Withdrawal Fee</li>
					<li class="bullet-item">1 Online Shop</li>
					<li class="bullet-item">No Gifts</li>
					<li class="bullet-item">No Discounts</li>
					<li class="cta-button">
						<a class="button"
							href="{{ action('Auth\AuthController@getIndex') }}">
							<i class="fa fa-fw fa-sign-in"></i>
							{{ trans('app.login') }}
						</a>
					</li>
				</ul>
			</li>
			<li>
				<ul class="pricing-table">
					<li class="title">Agency</li>
					<li class="price">100€/month</li>
					<li class="description">Advanced tools to manage your sales</li>
					<li class="bullet-item">Detailed order tracking</li>
					<li class="bullet-item">6% Withdrawal Fee</li>
					<li class="bullet-item">Custom Online Shop(s)</li>
					<li class="bullet-item">Send Gifts via E-mail</li>
					<li class="bullet-item">Discounts</li>
					<li class="bullet-item">Dedicated Support</li>
					<li class="description">Coming Soon</li>
				</ul>
			</li>
		</ul>

		<div class="welcome text-center">
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