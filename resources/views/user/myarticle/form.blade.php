@extends('user')

@section('content')
<div class="row">
    <div class="col-sm-12">
        @include('partials.error')
    </div>
    <div class="col-lg-10 col-lg-offset-1">
    {!! Form::model($myarticle, ['method' => !isset($params['id']) ? 'post' : 'put', 'url' => action($baseClass.'@'.$action, !isset($params) ? [] : $params), 'files' => true, 'id' => $base.'form', 'class' => 'form-horizontal']) !!}
        <div class="col-md-9">
            <div class="row form-group">
                <div class="col-sm-12">
                    {!!Form::text('title', $myarticle->title, ['class' => 'form-control input-lg input-myarticle', 'placeholder' => trans('livecms.title'), 'autofocus' => 'autofocus'])!!}            
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-12">
                    {!! Form::textarea('content', $myarticle->content, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-3">
                <div class="box-body">
                    {!! Form::label('picture', trans('livecms.picture'), ['class' => 'control-label']) !!}
                    @if ($picture = $myarticle->picture)
                    <div class="row">
                        <div class="col-sm-6 col-md-12">
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
                        @if ($picture = $myarticle->picture)
                            <strong>{{trans('backend.ifwanttochangepicture')}}</strong>
                        @endif
                            {!! Form::file('picture', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    {!! Form::label('category', trans('livecms.category'), ['class' => 'control-label']) !!}
                    {!! Form::select('categories[]', $categories, $myarticle->categories->pluck('id')->all(), ['class' => 'form-control', 'multiple' => true, 'data-tags' => true]) !!}
                </div>
                <div class="box-body">
                    {!! Form::label('tag', trans('livecms.tag'), ['class' => 'control-label']) !!}
                    {!! Form::select('tags[]', $tags, $myarticle->tags->pluck('id')->all(), ['class' => 'form-control', 'multiple' => true, 'data-tags' => true]) !!}
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-6 col-md-12">
                            {!! Form::submit('Simpan', ['class' => 'btn btn-success btn-block']) !!}
                        </div>
                        <div class="col-md-12 visible-md visible-lg">&nbsp;</div>
                        <div class="col-xs-6 col-md-12">
                            <a href="{{ action($baseClass.'@index') }}" class="btn btn-default btn-block">Batal</a>
                        </div>
                    </div>
            </div>
        </div>
    {!! Form::close() !!}
    </div>
</div>
@stop

@section('css.header')
<style type="text/css">
    input.form-control.input-lg.input-myarticle {
        border: 0;
        background: transparent;
        border-bottom: 2px solid #ddd;
    }
</style>
@stop