@extends('layout')

@section('title', $product->name)

@section('content')

@if(count($product->images))
<div class="medium-4 columns">
	@foreach($product->images as $image)
	<a class="th" data-reveal-id="image-{{ $image->id }}">
		@include('image.show', compact('image'))
	</a>
	<div id="image-{{ $image->id }}" data-reveal role="dialog"
		class="reveal-modal" style="text-align: center;">
	@include('image.show', compact('image'))
	</div>
	@endforeach
</div>
@endif

<div class="medium-4 columns">
	<p>{{ $product->name }}</p>
	<a class="button" id="buy">
		<i class="fa fa-2x fa-cart-plus"></i>
		{{ trans('Buy for ') }}
		@price($product)
	</a>
</div>

<div class="medium-4 columns">
	<table style="width: 100%">
		<tr><td class="label">Data:</td><td>Value</td></tr>
	</table>
</div>

{!! Form::close() !!}

@stop

@section('js')
$("#buy").click(function(){
	// Add to cart

	// Animation
	var dolly = $(".th").first()
	dolly = dolly.clone().css({ position: "absolute", top: dolly.offset().top, left: dolly.offset().left })
	dolly.css({ border: "none", opacity: 0 })
		.animate({ top: 0, left: $(window).width(), opacity: 1 }, 100)
	setTimeout(function(){ dolly.remove() }, 500)
	$("body").append(dolly)
})
@stop