@extends('layout')

@section('title', 'Products')

@section('content')
<ul class="small-block-grid-2 medium-block-grid-3" data-equalizer>
	@foreach($products as $product)
	<li data-equalizer-watch>
		<a href="{{ action('ProductController@show', $product->id) }}">
			<div class="th">
				@include('image.show', ['image' => count($product->images) ? $product->images[0] : null])
			</div>
			<h4>{{ $product->name }}</h4>
		</a>
	</li>
	@endforeach
</ul>
@stop