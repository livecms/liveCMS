@extends('backend')

@section('form')
	
	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('category', trans('livecms.category'), ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('category', $projectcategory->category, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('slug', 'Slug', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('slug', $projectcategory->slug, ['class' => 'form-control']) !!}
		</div>
	</div>

@stop

@section('content')
@include('partials.form')
@stop