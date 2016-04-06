@extends('backend')

@section('form')
    @include('partials.error')

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('name', trans('livecms.name'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('name', $client->name, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('slug', trans('livecms.slug'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('slug', $client->slug, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('url', trans('livecms.url'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            <p class="form-static"><a href="{{$url = $client->url}}">{{$url}}</a></p>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('permalink', trans('livecms.permalink'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('permalink', $client->permalink ? $client->permalink->permalink : '', ['class' => 'form-control', 'placeholder' => url('path/sebagai/permalink')]) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('description', trans('livecms.description'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::textarea('description', $client->description, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('picture', trans('livecms.picture'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            @if ($picture = $client->picture)
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    Preview :
                    <figure style="width: 100%;">
                        <img src="{{ $picture }}" class="img-responsive" alt="">
                    </figure>
                    <div class="row">&nbsp;</div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                @if ($picture = $client->picture)
                    <strong>{{trans('backend.ifwanttochangepicture')}}</strong>
                @endif
                    {!! Form::file('picture', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

@stop

@section('content')
@include('partials.form', ['width' => '12', 'files' => true])
@stop