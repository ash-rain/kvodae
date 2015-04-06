<div class="product th framed-white"
	style="background-image: url({{ url('/images/' . $product->images[0]->id) }})">
	<div class="action row collapse trans-opacity">
		<div class="small-6 columns">
			<a class="button full trans-opacity buy"
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
	</div>
</div>