@extends('backend')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('judul', 'Judul', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::text('judul', $staticPage->judul, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('slug', 'Slug', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::text('slug', $staticPage->slug, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('permalink', 'Permalink', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::text('permalink', $staticPage->permalink ? $staticPage->permalink->permalink : '', ['class' => 'form-control', 'placeholder' => url('path/sebagai/permalink')]) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('url', 'Url', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			<p class="form-static"><a href="{{$staticPage->url}}">{{$staticPage->url}}</a></p>
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('isi', 'Isi', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::textarea('isi', $staticPage->isi, ['class' => 'form-control']) !!}
		</div>
	</div>

@stop

@section('content')
@include('partials.form', ['width' => '12'])
@stop