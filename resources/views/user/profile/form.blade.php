@section('form')
    @include('partials.error')
    
    <div class="row form-group">
        {!! Form::label('name', trans('livecms.name'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('name', $profile->name, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        {!! Form::label('email', trans('livecms.email'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('email', $profile->email, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        {!! Form::label('username', trans('livecms.username'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('username', $profile->username, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        {!! Form::label('about', trans('livecms.about'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('about', $profile->about, ['class' => 'form-control', 'style' => 'height: 80px;']) !!}
        </div>
    </div>

    <hr>
    <div class="row form-group">
        {!! Form::label('mediasocial', trans('livecms.mediasocial'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-9">
            @if (isset($socials))
            @foreach ($socials as $social => $socialTitle)
            <div class="row form-group">
                <div class="col-sm-3 col-lg-2">
                    {!! Form::label($social, $socialTitle, ['class' => 'control-label']) !!}
                </div>
                <div class="col-sm-9 col-lg-10">
                    {!! Form::text('mediasocials['.$social.']', ($socialInfo = $profile->socials()->where('social', $social)->first()) ? $socialInfo->url : '', ['class' => 'form-control', 'placeholder' => trans('livecms.url')]) !!}
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>

@stop

@section('profile.form')
{!! Form::model($profile, ['method' => !isset($params['id']) ? 'post' : 'put', 'url' => action($baseClass.'@'.$action, !isset($params) ? [] : $params), 'files' => isset($files) ?: false, 'id' => $base.'form', 'class' => 'form-horizontal']) !!}
                
@yield('form')

<div class="row form-group">
    <div class="col-sm-2">&nbsp;</div>
    <div class="col-sm-9">
        {!! Form::submit('Update', ['class' => 'btn btn-danger']) !!}
    </div>
</div>

{!! Form::close() !!}
@stop