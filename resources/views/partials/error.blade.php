@if($errors->any())
<div class="alert alert-warning">
    @if ($errors->count() === 1 && $errors->first('passwordprivilege'))
    <h4>{{trans('backend.needyourpasswordtocontinue')}}</h4>
    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('passwordprivilege', trans('livecms.password'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9">
            {!! Form::password('passwordprivilege', ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
            <h5>{{$errors->first('passwordprivilege')}}</h5>
        </div>
    </div>
    @else
    <h4>Terjadi error</h4>
    @endif
    <ul class="list-unstyled">
        @foreach ($errors->all() as $error)
            @if (! str_contains($error, trans('livecms.passwordprivilege')))
            <li>{{ $error }}</li>
            @endif
        @endforeach
    </ul>
</div>
@endif