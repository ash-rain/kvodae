@extends('layout')

@section('title', trans('app.checkout'))

@section('content')
{!! Form::open(['url' => 'CheckoutController@postCheckout', 'method' => 'post']) !!}
	<div class="row">
		<div class="medium-8 medium-centered columns">
			<div class="row">
				<div class="small-6 columns"> 
					<h3>Payment Method</h3>
					<div>
						{!! Form::radio('method', true, ['disabled']) !!}
						{!! Form::label('PayPal') !!}
					</div>
				</div>
				<div class="small-6 columns"> 
					<a class="submit framed full button">
						{{ trans('app.checkout') }}
						{{ Cart::getTotal() }}
						{{ config('app.currency') }}
					</a>
				</div>
			</div>
			
			<h3>Shipping Info</h3>
			
			<div class="row">
				<div class="small-6 columns"> 
					{!! Form::label('country') !!}
					{!! Form::text('country') !!}
				</div>
				<div class="small-6 columns"> 
					{!! Form::label('region') !!}
					{!! Form::text('region') !!}
				</div>
				<div class="small-6 columns"> 
					{!! Form::label('city') !!}
					{!! Form::text('city') !!}
				</div>
				<div class="small-6 columns"> 
					{!! Form::label('post_code') !!}
					{!! Form::text('post_code') !!}
				</div>
			</div>

			{!! Form::label('address') !!}
			{!! Form::text('address') !!}

			{!! Form::label('notes') !!}
			{!! Form::textarea('notes', null, ['rows' => 3]) !!}
			
			<p>{{ trans('product.shipping_info') }}</p>

		</div>
	</div>
{!! Form::close() !!}
@stop