@extends('layout')

@section('title', trans('product.create'))

@include('shared.number')

@section('content')

{!! Form::open([ 'url' => action('ProductController@store'), 'method' => 'post' ]) !!}

<input type="hidden" name="template_id" value="{{ $template->id }}" />

<div class="row">
	<div class="medium-6 medium-centered columns">
		<a class="submit button full framed" href="javascript:void(0)">
			{{ trans('app.create') }}
			<i class="fa fa-arrow-right"></i>
		</a>

		<div class="form">
			<label>
				{{ trans('app.name') }}
				<input type="text" name="name" value="{{ old('name') }}" required />
			</label>

			<label>
				{{ trans('app.price') }}

				<div class="row collapse">
					<div class="small-3 columns">
						<span class="prefix">
							{{ $template->price }}
							{{ config('app.currency') }}
							<i class="fa fa-plus"></i>
						</span>
					</div>
					<div class="small-9 columns">
						<input type="number" name="price" value="{{ old('price') }}" />
					</div>
				</div>
			</label>

			<label>
				<input type="checkbox" checked />
				{{ trans('product.for_sale') }}
			</label>
		</div>
	</div>

	<div class="medium-6 columns">
	</div>
</div>

{!! Form::close() !!}

@stop