@extends('layout')

@section('title', 'Products')

@section('content')
<ul class="small-block-grid-2 medium-block-grid-4">
	@foreach($products as $product)
	<li>
		<a href="{{ action('ProductController@show', $product->id) }}">
			<div class="th"> 
				@include('image.show', ['image' => $product->images[0]])
			</div>
			<h4>{{ $product->name }}</h4>
		</a>
	</li>
	@endforeach
</ul>
@stop