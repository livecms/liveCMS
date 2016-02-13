@extends('backend')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('judul', 'Judul', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::text('judul', $static_page->judul, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('slug', 'Slug', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::text('slug', $static_page->slug, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('isi', 'Isi', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::textarea('isi', $static_page->isi, ['class' => 'form-control']) !!}
		</div>
	</div>

@stop

@section('content')
@include('partials.form', ['width' => '12'])
@stop