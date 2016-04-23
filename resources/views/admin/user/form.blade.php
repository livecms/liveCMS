@extends('backend')

@section('form')
	
	@include('partials.error', ['hasOnly' => 'credentials'])

    {!!Form::hidden('credentials', true)!!}
	
	<div class="row form-group">
        {!! Form::label('newpassword', trans('livecms.newpassword'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::input('password', 'newpassword', old('newpassword'), ['class' => 'form-control']) !!}
        </div>
    </div>
    
    <div class="row form-group">
        {!! Form::label('newpassword_confirmation', trans('livecms.newpassword_confirmation'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::input('password', 'newpassword_confirmation', old('newpassword_confirmation'), ['class' => 'form-control']) !!}
        </div>
    </div>

@stop

@section('content')
@include('partials.form')
@stop