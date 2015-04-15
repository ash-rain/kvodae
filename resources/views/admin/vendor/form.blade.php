@extends('layout')

@section('title', 'Vendors')

@section('content')

<div class="form">
@if($vendor->id)
{!! Form::model($vendor, ['url' => action('Admin\VendorController@update', $vendor->id), 'method' => 'patch']) !!}
@else
{!! Form::model($vendor, ['url' => action('Admin\VendorController@store')]) !!}
@endif
	<a class="submit button right">
		<i class="fa fa-check"></i>
		{{ trans('app.save') }}
	</a>
	<ul class="small-block-grid-2">
		<li>
		{!! Form::label('name') !!}
		{!! Form::text('name') !!}
		</li>

		<li>
		{!! Form::label('phone') !!}
		{!! Form::text('phone') !!}
		</li>

		<li>
		{!! Form::label('address') !!}
		{!! Form::textarea('address', null, ['rows' => 5]) !!}
		</li>

		<li>
		{!! Form::label('notes') !!}
		{!! Form::textarea('notes', null, ['rows' => 5]) !!}
		</li>
	</ul>
{!! Form::close() !!}
</div>

@stop