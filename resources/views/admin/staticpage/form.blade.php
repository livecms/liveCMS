@extends('backend')

@section('form')
	@include('partials.error')
	@include('partials.postableForm', ['model' => $staticpage])

	<div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('parent', trans('livecms.parent'), ['class' => 'control-label']) !!}
        </div>

        <div class="col-md-10">
            {!! Form::select('parent', $parents, $staticpage->parent_id, ['class' => 'form-control']) !!}
        </div>
    </div>

@stop

@section('content')
@include('partials.form', ['width' => '12', 'files' => true])
@stop