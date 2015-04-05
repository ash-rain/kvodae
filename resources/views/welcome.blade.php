@extends('layout')

@section('scripts')
<script type="text/javascript" src="{{ asset('js/view/buy.js') }}"></script>
@stop

@section('js')
var token = "{{ csrf_token() }}"
@stop

@section('content')

<h1>{{ trans('product.latest') }}</h1>

<ul class="small-block-grid-2 medium-block-grid-4">
@foreach($latest as $product)
	<li>@include('product.tile')</li>
@endforeach
</ul>

@stop