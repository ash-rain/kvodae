@extends('layout')

@section('title', trans('app.checkout'))

@section('content')
<h1 class="text-centered">
	<i class="fa fa-check-circle"></i>
	{{ trans('app.checkout_done') }}
</h1>
@stop