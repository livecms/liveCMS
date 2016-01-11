@extends('backend')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('tag', 'Tag', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('tag', $tag->tag, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('slug', 'Slug', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('slug', $tag->slug, ['class' => 'form-control']) !!}
		</div>
	</div>

@stop

@section('content')
@include('partials.form')
@stop