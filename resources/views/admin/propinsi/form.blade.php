@extends('backend')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('propinsi', 'Propinsi', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('propinsi', $propinsi->propinsi, ['class' => 'form-control']) !!}
		</div>
	</div>
@stop

@section('content')
@include('partials.form')
@stop