@extends('backend')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('judul', 'Judul', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('judul', $artikel->judul, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('slug', 'Slug', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('slug', $artikel->slug, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('isi', 'Isi', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::textarea('isi', $artikel->isi, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('kategori', 'Kategori', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::select('kategoris[]', $kategoris, $artikel->kategoris->lists('id')->all(), ['class' => 'form-control', 'multiple' => true]) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('tag', 'Tag', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::select('tags[]', $tags, $artikel->tags->lists('id')->all(), ['class' => 'form-control', 'multiple' => true]) !!}
		</div>
	</div>

@stop

@section('content')
@include('partials.form', ['width' => '10'])
@stop