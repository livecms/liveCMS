@extends('backend')

@section('form')
	@include('partials.error')
	@include('partials.postableForm', ['model' => $project])

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('category', trans('livecms.category'), ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::select('categories[]', $categories, $project->categories->pluck('id')->all(), ['class' => 'form-control', 'multiple' => true]) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-2">
			{!! Form::label('client', 'Client', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-10">
			{!! Form::select('client', [null => trans('backend.choose')] + $client, $project->client_id, ['class' => 'form-control']) !!}
		</div>
	</div>
@stop

@section('content')
@include('partials.form', ['width' => '12', 'files' => true])
@stop