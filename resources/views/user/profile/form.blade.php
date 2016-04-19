@section('form')
    @include('partials.error', ['hasOnly' => 'profiles', 'passwordprivilege' => 'password'])
    
    {!!Form::hidden('profiles', true)!!}

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
        {!! Form::label('jobtitle', trans('livecms.jobtitle'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('jobtitle', $profile->jobtitle, ['class' => 'form-control']) !!}
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
            @foreach ($profile->socialMedias() as $social)
            <div class="row form-group">
                <label for="social-{{$social}}" class="col-xs-2 control-label">
                    <a href="javascript:;" class="btn btn-sm btn-social-icon btn-{{$social == 'google-plus' ? 'google' : $social}}"><i class="fa fa-{{$social}}"></i></a>
                </label>
                <div class="col-xs-10">
                    {!! Form::text('socials['.$social.']', $profile->getSocials($social), ['class' => 'form-control', 'placeholder' => title_case($social).' '.trans('livecms.url')]) !!}
                </div>
            </div>
            @endforeach
        </div>
    </div>

@stop

@section('profile.form')
@include('user.partials.form')
@stop



@section('form.avatars')
    @include('partials.error', ['hasOnly' => 'avatars', 'passwordprivilege' => 'password'])
    
    {!!Form::hidden('avatars', true)!!}

    <div class="row form-group">
        {!! Form::label('avatar', trans('livecms.avatar'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            @if ($avatar = $profile->avatar)
            <div class="row">
                <div class="col-xs-8 col-sm-4">
                    <figure style="width: 100%;">
                        <img src="{{ $avatar }}" class="img-responsive" alt="{{basename($avatar)}}" title="{{basename($avatar)}}">
                    </figure>
                    <div class="row">&nbsp;</div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                @if ($avatar = $profile->avatar)
                    <strong>{{trans('backend.ifwanttochangeavatar')}}</strong>
                @endif
                    {!! Form::file('avatar', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row form-group">
        {!! Form::label('background', trans('livecms.background'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            @if ($background = $profile->background)
            <div class="row">
                <div class="col-sm-8">
                    <figure style="width: 100%;">
                        <img src="{{ $background }}" class="img-responsive" alt="{{basename($background)}}" title="{{basename($background)}}">
                    </figure>
                    <div class="row">&nbsp;</div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                @if ($background = $profile->background)
                    <strong>{{trans('backend.ifwanttochangebackground')}}</strong>
                @endif
                    {!! Form::file('background', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    

@stop

@section('profile.form.avatars')
@include('user.partials.form', ['form' => 'form.avatars', 'files' => true])
@stop


@section('form.credentials')
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

@section('profile.form.credentials')
@include('user.partials.form', ['form' => 'form.credentials'])
@stop