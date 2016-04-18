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
                    <a href="#" class="btn btn-sm btn-social-icon btn-{{$social == 'google-plus' ? 'google' : $social}}"><i class="fa fa-{{$social}}"></i></a>
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



@section('form.2')
    @include('partials.error')
    
    <div class="row form-group">
        {!! Form::label('name', trans('livecms.name'), ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('name', $profile->name, ['class' => 'form-control']) !!}
        </div>
    </div>

    

@stop

@section('profile.form.2')
@include('user.partials.form', ['form' => 'form.2'])
@stop