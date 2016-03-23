@extends('backend')

@section('form')

    @include('partials.error')
    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('title', 'Judul', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('title', $model->title, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('slug', 'Slug', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('slug', $model->slug, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('url', 'Url', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            <p class="form-static"><a href="{{$url = $model->url}}">{{$url}}</a></p>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('permalink', 'Permalink', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('permalink', $model->permalink ? $model->permalink->permalink : '', ['class' => 'form-control', 'placeholder' => url('path/sebagai/permalink')]) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('content', trans('livecms.content'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::textarea('content', $model->content, ['class' => 'form-control']) !!}
        </div>
    </div>

@stop

@section('content')
@include('partials.form', ['width' => '12'])
@stop