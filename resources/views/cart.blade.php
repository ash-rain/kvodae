@extends('layout')

@include('shared.number')

@section('js')
$("input[name='quantity']").bind("keyup", function() {
	var q = parseInt($(this).val())
	if(!q) return
	var form = $(this).parents("form")
	var t = form.find("input[name='_token']").val()
	var m = form.find("input[name='_method']").val()
	$.post(form.attr("action"), { quantity: q, _token: t, _method: m })
})
$("[data-delete]").click(function() {
	if(!confirm("{{ trans('Are you sure?') }}")) return
	var form = $(this).parents("form")
	var t = form.find("input[name='_token']").val()
	$.post(form.attr("action"), { _token: t, _method: "DELETE" })
	$(this).parents("li").hide(300, function(){
		$(this).remove()
		if(!$(this).siblings().length) document.location = "{{ url('home') }}"
	})
})
@stop

@section('content')
@if(count($cart))

<h1>
	<a class="button success right" href="{{ action('CheckoutController@getIndex') }}">
		<i class="fa fa-arrow-right"></i>
		{{ trans('app.checkout') }}
	</a>
	<div class="right" style="padding-right: 1em">
		<small>
			{{ trans('app.cart_total') }}
			{{ Cart::getTotal() }}
			{{ config('app.currency') }}
		</small>
	</div>
	{{ trans('app.cart') }}
</h1>

<hr />

<ul class="small-block-grid-2 medium-block-grid-3">
	@foreach($cart as $item)
	<li>
	{!! Form::open([ 'url' => action('CartController@update', $item['id']), 'method' => 'patch' ]) !!}
	<p>
		<div class="product th">
			@include('image.show', ['image' => $item['product']->images[0]])
			<div class="action row collapse trans-opacity">
				<div class="small-6 columns">
					<a class="button full trans-opacity"
						href="{{ action('ProductController@show', $item['id']) }}">
						<div class="y-center">
							<p>
								<i class="fa fa-2x fa-search-plus buy"></i>
							</p>
							<p></p>
							{{ trans('product.more_info') }}
						</div>
					</a>
				</div>
				<div class="small-6 columns">
					<a class="alert button full trans-opacity"
						data-delete="{{ $item['id'] }}">
						<div class="y-center">
							<p>
								<i class="fa fa-2x fa-remove"></i>
							</p>
							<p></p>
							{{ trans('app.cart_remove') }}
						</div>
					</a>
				</div>
			</div>
		</div>
	</p>
	<div class="row collapse">
		<div class="small-5 columns">
			<div class="row collapse">
				<div class="small-7 columns">
					<span class="prefix">
						@price($item['product'])
						<i class="fa fa-times"></i>
					</span>
				</div>
				<div class="small-5 columns">
					<input type="number" name="quantity"
					data-id="{{ $item['id'] }}"
					value="{{ $item['quantity'] }}" />
				</div>
			</div>
		</div>
		<div class="small-7 columns" style="padding-left: 1em;">
			<h4>{{ $item['name'] }}</h4>
		</div>
	</div>
	{!! Form::close() !!}
	</li>
	@endforeach
</ul>
@else
<div class="text-center">
	<i>{{ trans('Your cart is empty') }}</i>
</div>
@endif
@stop