@extends('backend')

@section('form')
	@include('partials.error')
	@include('partials.postableForm', ['model' => $gallery])
@stop

@section('content')
@include('partials.form', ['width' => '12', 'files' => true])
@stop