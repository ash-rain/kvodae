@extends('layout')

@section('title', trans('product.index'))

@section('js')
var token = "{{ csrf_token() }}"
@stop

@section('content')
<div class="row">
	<div class="medium-5 large-4 columns">
		<h1>
			{{ trans('product.index') }}
		</h1>
		<hr />
		<div class="filter">
			<button class="dropdown" data-dropdown="drop_order_by">
				{{ trans('filter.order_by') }}
			</button>
			<ul id="drop_order_by" data-dropdown-content
				class="f-dropdown text-right">
				@foreach(['cheapest', 'newest', 'popular', 'sales'] as $criteria)
				<li {{ $criteria == 'popularity' ? 'class=active' : '' }}>
					<a href="#">
						{{ trans('filter.order_by.' . $criteria) }}
					</a>
				</li>
				@endforeach
			</ul>

			<button class="dropdown" data-dropdown="drop_material">
				{{ trans('filter.material') }}
			</button>
			<div id="drop_material" data-dropdown-content
				class="f-dropdown content">
				
				@foreach(['metal', 'plastic', 'rubber'] as $material)
				<div class="clearfix">
					<div class="right success switch">
						<input id="{{ $material }}" type="checkbox" checked />
						<label for="{{ $material }}"></label>
					</div>
					<h5 class="right" style="padding-right: .5em;">
						{{ trans('material.' . $material) }}
					</h5>
				</div>
				@endforeach

			</div>
		</div>
	</div>
	<div class="medium-7 large-8 columns">
		<ul class="small-block-grid-2 large-block-grid-3">
			@foreach($products as $product)
			<li>
				@include('product.tile')
			</li>
			@endforeach
		</ul>
	</div>
</div>
@stop