@extends('layout')

@section('title', 'Vendors')

@section('content')

<h1>
	Vendors
	<a class="right button framed" href="{{ action('Admin\VendorController@create') }}">
		<i class="fa fa-plus"></i>
		{{ trans('app.create') }}
	</a>
</h1>

@if(count($vendors))
<ul class="form small-block-grid-3">
	@foreach ($vendors as $vendor)
	<li>
			<a class="full button" href="{{ action('Admin\VendorController@edit', $vendor->id) }}">
				{{ $vendor->name }}
				<div class="right">
					<i class="fa fa-book"></i>
					{{ count($vendor->templates) }}
				</div>
			</a>
	</li>
	@endforeach
</ul>
@else
	<h1>No vendors to display.</h1>
@endif
</div>

@stop