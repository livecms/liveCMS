@extends('backend')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('judul', 'Judul', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::text('judul', $artikel->judul, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('slug', 'Slug', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::text('slug', $artikel->slug, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('isi', 'Isi', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::textarea('isi', $artikel->isi, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('kategori', 'Kategori', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::select('kategoris[]', $kategoris, $artikel->kategoris->lists('id')->all(), ['class' => 'form-control', 'multiple' => true]) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('tag', 'Tag', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::select('tags[]', $tags, $artikel->tags->lists('id')->all(), ['class' => 'form-control', 'multiple' => true]) !!}
		</div>
	</div>

@stop

@section('content')
@include('partials.form', ['width' => '12'])
@stop