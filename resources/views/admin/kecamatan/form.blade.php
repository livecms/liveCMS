@extends('backend')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('kecamatan', 'Kecamatan', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('kecamatan', $kecamatan->kecamatan, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('kota', 'Kota', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::select('kota', $kotas, $kecamatan->kota_id, ['class' => 'form-control']) !!}
		</div>
	</div>

@stop

@section('content')
@include('partials.form', ['width' => '10'])
@stop