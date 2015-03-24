@extends('layout')

@section('title', trans('product.index'))

@section('scripts')
<script type="text/javascript" src="{{ asset('js/view/buy.js') }}"></script>
@stop

@section('js')
var token = "{{ csrf_token() }}"
@stop

@section('content')
@parent
<ul class="medium-block-grid-4" data-equalizer>
	@foreach($products as $product)
	<li data-equalizer-watch>
		<h3>
		 	<a href="{{ action('ProductController@show', $product->id) }}">
				{{ $product->name }}
			</a>
		</h3>
		<div class="product th">
			@include('image.show', ['image' => count($product->images) ? $product->images[0] : null])
			<div class="action row collapse trans-opacity">
				<div class="small-6 columns">
					<a class="button full trans-opacity"
						href="{{ action('ProductController@show', $product->id) }}">
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
					<a class="success button full trans-opacity buy"
						data-id="{{ $product->id }}">
						<div class="y-center">
							<p>
								<i class="fa fa-2x fa-cart-plus buy"></i>
							</p>
							<p></p>
							{{ trans('app.buy_for') }}
							<p>@price($product)</p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</li>
	@endforeach
</ul>
@stop