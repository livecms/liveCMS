@extends('backend')

@section('form')
	
	@include('partials.error')

    {!!Form::hidden('profiles', true)!!}

    <div class="row form-group">
        {!! Form::label('name', trans('livecms.name'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        {!! Form::label('email', trans('livecms.email'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        {!! Form::label('username', trans('livecms.username'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('username', $user->username, ['class' => 'form-control']) !!}
        </div>
    </div>
	
	<div class="row form-group">
        {!! Form::label('password', trans('livecms.password'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::input('password', 'password', old('password'), ['class' => 'form-control']) !!}
        </div>
    </div>
    
    <div class="row form-group">
        {!! Form::label('password_confirmation', trans('livecms.password_confirmation'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::input('password', 'password_confirmation', old('password_confirmation'), ['class' => 'form-control']) !!}
        </div>
    </div>

@stop

@section('content')
@include('partials.form')
@stop