@extends('backend')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('permalink', 'Tag', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('permalink', $permalink->permalink, ['class' => 'form-control']) !!}
		</div>
	</div>

@stop

@section('content')
@include('partials.form')
@stop