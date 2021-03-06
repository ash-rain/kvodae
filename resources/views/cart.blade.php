@extends('layout')

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
		location.reload()
	})
})
@stop

@section('content')
@if(count($cart))

<h1>
	<a class="button framed right" id="pay"
		href="{{ action('CheckoutController@getIndex') }}">
		<i class="fa fa-paypal"></i>
		{{ trans('app.checkout') }}
		{{ Cart::getTotal() }}
		{{ config('app.currency') }}
	</a>
	{{ trans('app.cart') }}
</h1>

<hr />

<ul class="small-block-grid-1 large-block-grid-2">
	@foreach($cart as $item)
	<li>
	{!! Form::open([ 'url' => action('CartController@update', $item['id']), 'method' => 'patch' ]) !!}
	<div class="row">
		<div class="small-6 columns">
			<div class="product th"
				style="background-image: url(/images/{{ $item['product']->images[0]->id }});">
				<div class="action row collapse trans-opacity">
					<div class="small-6 columns">
						<a class="button full trans-opacity"
							href="{{ action('ProductController@show', $item['id']) }}">
							<div class="y-center">
								<p>
									<i class="fa fa-2x fa-search-plus"></i>
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
		</div>
		<div class="small-6 columns">
			<h2>
				{{ $item['name'] }}
				<div class="subtitle">
					<div class="label">@price($item['product'])</div>
					<div class="label">
						{{ $item['product']->template->name }}
					</div>
				</div>
			</h2>
		</div>
	</div>
	{!! Form::close() !!}
	</li>
	@endforeach
</ul>
@else
<div class="text-center">
	<h2>
		<i class="fa fa-2x fa-info-circle"></i>
		<br />
		{{ trans('Your cart is empty') }}
	</h2>
	just like a life without beer
</div>
@endif
@stop