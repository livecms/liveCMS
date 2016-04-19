@extends('backend')

@section('form')
    @include('partials.error')

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('name', trans('livecms.name'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('name', $team->name, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('role', trans('livecms.role'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('role', $team->role, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('slug', trans('livecms.slug'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('slug', $team->slug, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('url', trans('livecms.url'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            <p class="form-static"><a href="{{$url = $team->url}}">{{$url}}</a></p>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('permalink', trans('livecms.permalink'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('permalink', $team->permalink ? $team->permalink->permalink : '', ['class' => 'form-control', 'placeholder' => url('path/sebagai/permalink')]) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('description', trans('livecms.description'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::textarea('description', $team->description, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('picture', trans('livecms.picture'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            @if ($picture = $team->picture)
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
                @if ($picture = $team->picture)
                    <strong>{{trans('backend.ifwanttochangepicture')}}</strong>
                @endif
                    {!! Form::file('picture', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="row form-group">
        {!! Form::label('mediasocial', trans('livecms.mediasocial'), ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            @foreach ($socials as $social => $socialTitle)
            <div class="row form-group">
                <label for="{{$social}}" class="col-xs-1">
                    <a href="javascript:;" class="btn btn-sm btn-social-icon btn-{{$social == 'google-plus' ? 'google' : $social}}"><i class="fa fa-{{$social}}"></i></a>
                </label>
                <div class="col-sm-8">
                    {!! Form::text('socials['.$social.']', ($socialInfo = $team->socials()->where('social', $social)->first()) ? $socialInfo->url : '', ['class' => 'form-control', 'placeholder' => title_case($social).' '.trans('livecms.url')]) !!}
                </div>
            </div>
            @endforeach
        </div>
    </div>
@stop

@section('content')
@include('partials.form', ['width' => '12', 'files' => true])
@stop