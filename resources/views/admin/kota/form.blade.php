@extends('backend')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('kota', 'Kota', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('kota', $kota->kota, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('tipe', 'Tipe', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::select('tipe', $kota->defTipe, $kota->tipe, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('propinsi', 'Propinsi', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::select('propinsi', $propinsis, $kota->propinsi_id, ['class' => 'form-control']) !!}
		</div>
	</div>

@stop

@section('content')
@include('partials.form', ['width' => '10'])
@stop