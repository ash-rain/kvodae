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
<div class="medium-5 columns">
	@foreach($product->images as $image)
	<a class="th" data-reveal-id="image-{{ $image->id }}">
		@include('image.show', compact('image'))
	</a>
	<div id="image-{{ $image->id }}" data-reveal role="dialog"
		class="reveal-modal" style="text-align: center;">
		@include('image.show', compact('image'))
	</div>
	@endforeach
	<p></p>
	<i>{{ trans('product.shipping_info') }}</i>
</div>
@endif

<div class="medium-7 columns">
	<h1>{{ $product->name }}</h1>

	<a class="button success full buy" id="buy"
		data-id="{{ $product->id }}">
		<div class="row collapse">
			<div class="small-10 medium-11 columns">
				{{ trans('app.buy_for') }}
				@price($product)
			</div>
			<div class="small-2 medium-1 columns">
				<i class="fa fa-cart-plus"></i>
			</div>
		</div>
	</a>

	@if($product->description)
	<p>{!! nl2br($product->description) !!}</p>
	@endif

	@if($product->template->specs)
	<table class="full specs" cellspacing="0">
		@foreach($product->template->specs as $key => $value)
		<tr>
			<td class="key" width="20">{{ $key }}</td>
			<td class="value">{{ $value }}</td>
		</tr>
		@endforeach
	</table>
	@endif
</div>

{!! Form::close() !!}

@stop