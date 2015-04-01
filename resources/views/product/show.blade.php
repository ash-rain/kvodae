@extends('layout')

@section('title', $product->name)

@section('scripts')
<script type="text/javascript" src="{{ asset('js/view/buy.js') }}"></script>
@stop

@section('js')
var token = "{{ csrf_token() }}"
@stop

@section('content')

@if(count($product->images))
<div class="medium-6 large-4 columns" id="images">
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

<div class="medium-6 large-8 columns">
	<h1>{{ $product->name }}</h1>

	<a class="button success full buy" id="buy"
		data-anim="#images" data-id="{{ $product->id }}">
		<i class="fa fa-cart-plus"></i>
		{{ trans('app.buy_for') }}
		<div class="right">
			@price($product)
		</div>
	</a>

	<p id="shipping_info">{{ trans('product.shipping_info') }}</p>

	<div class="row collapse">
		@if($product->description)
		<div class="large-6 columns"> 
			<p>{!! nl2br($product->description) !!}</p>
		</div>
		@endif
		
		@if($product->template->specs)
		<div class="large-6 columns"> 
			<table class="full specs" cellspacing="0">
				@foreach($product->template->specs as $key => $value)
				<tr>
					<td class="key" width="20">{{ trans('specs.' . $key) }}</td>
					<td class="text-right">{{ $value }}</td>
				</tr>
				@endforeach
			</table>
		</div>
		@endif
	</div>
</div>

<div class="small-12 columns">
	<h2>{{ trans('product.related') }}</h2>
	<ul class="small-block-grid-2 large-block-grid-4">
	@foreach($related as $product)
		<li>
		@include('product.tile')
		</li>
	@endforeach
	</ul>
</div>

{!! Form::close() !!}

@stop