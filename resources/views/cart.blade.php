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
	$(this).parents("li").hide(300)
})
@stop

@section('content')
@if(count($cart))
<ul class="small-block-grid-2 medium-block-grid-3">
	@foreach($cart as $item)
	<li>
	{!! Form::open([ 'url' => action('CartController@update', $item['id']), 'method' => 'patch' ]) !!}
	<p>
		<a class="th"
			href="{{ action('ProductController@show', $item['product']->id) }}">
			@include('image.show', ['image' => $item['product']->images[0]])
		</a>
	</p>
	<div class="row">
		<div class="small-3 columns">
			<input type="number" name="quantity" data-id="{{ $item['id'] }}"
				value="{{ $item['quantity'] }}" />
		</div>
		<div class="small-6 columns">
			<h4>{{ $item['name'] }}</h4>
		</div>
		<div class="small-3 columns">
			<a class="tiny button alert full" data-delete="{{ $item['id'] }}">
				<i class="fa fa-remove"></i>
			</a>
		</div>
	</div>
	{!! Form::close() !!}
	</li>
	@endforeach
</ul>
@else
	<i>{{ trans('Your cart is empty') }}</i>
@endif
@stop