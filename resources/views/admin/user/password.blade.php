@extends('backend')

@section('form')
	
	@include('partials.error', ['hasOnly' => 'credentials'])

    {!!Form::hidden('credentials', true)!!}

    <div class="row form-group">
        {!! Form::label('name', trans('livecms.name'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::label('name', $user->name, ['class' => 'form-control-static'. ($user->is_banned) ? ' text-red' : '']) !!}
        </div>
    </div>

    <div class="row form-group">
        {!! Form::label('email', trans('livecms.email'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::label('email', $user->email, ['class' => 'form-control-static'. ($user->is_banned) ? ' text-red' : '']) !!}
        </div>
    </div>

    <div class="row form-group">
        {!! Form::label('username', trans('livecms.username'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::label('username', $user->username, ['class' => 'form-control-static'. ($user->is_banned) ? ' text-red' : '']) !!}
        </div>
    </div>
	
	<div class="row form-group">
        {!! Form::label('newpassword', trans('livecms.newpassword'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::input('password', 'newpassword', old('newpassword'), ['class' => 'form-control', 'disabled' => ($user->is_banned) ? 'disabled' : null]) !!}
        </div>
    </div>
    
    <div class="row form-group">
        {!! Form::label('newpassword_confirmation', trans('livecms.newpassword_confirmation'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::input('password', 'newpassword_confirmation', old('newpassword_confirmation'), ['class' => 'form-control', 'disabled' => ($user->is_banned) ? 'disabled' : null]) !!}
        </div>
    </div>

    <div class="row form-group">
        {!! Form::label('admin', trans('livecms.makeadmin'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
			<div class="btn-group" role="group">
        		{!! Form::submit(trans('livecms.yes'), ['name' => 'admin_yes', 'class' => 'btn bg-navy', 'disabled' => ($user->is_admin || $user->is_banned) ? 'disabled' : null]) !!}
        		{!! Form::submit(trans('livecms.no'), ['name' => 'admin_no', 'class' => 'btn btn-default', 'disabled' => ($user->is_admin) ? null : 'disabled']) !!}
			</div>
			&nbsp;
			{!!$user->is_banned ? '<span class="text-red">'.trans('backend.isbanned').'</span>' : trans('backend.is'.($user->is_admin ? '' : 'not').'admin')!!}
        </div>
    </div>

    @if ($user->is_banned)
    <hr>
    <div class="row form-group">
        {!! Form::label('uban', trans('livecms.unbanuser'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
        	{!! Form::submit(trans('livecms.unban'), ['name' => 'unban', 'class' => 'btn bg-navy']) !!}
        </div>
    </div>
    @endif
    
@stop

@section('content')
@include('partials.form')
@stop