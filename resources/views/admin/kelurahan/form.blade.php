@extends('backend')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('kelurahan', 'Kelurahan', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('kelurahan', $kelurahan->kelurahan, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('tipe', 'Tipe', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::select('tipe', $kelurahan->defTipe, $kelurahan->tipe, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('kecamatan', 'Kecamatan', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::select('kecamatan', $kecamatans, $kelurahan->kecamatan_id, ['class' => 'form-control']) !!}
		</div>
	</div>

@stop

@section('content')
@include('partials.form', ['width' => '10'])
@stop