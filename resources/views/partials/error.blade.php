<?php

use Illuminate\Support\Str;

$passwordprivilege = isset($passwordprivilege) ? $passwordprivilege : 'passwordprivilege';
?>

@if($errors->any() && ( !isset($hasOnly) ?: old($hasOnly)))
<div id="form-alert" class="alert alert-warning" @if (isset($hasOnly)) data-errors="{{$hasOnly}}"  @endif>
    @if ($errors->count() === 1 && $errors->first($passwordprivilege))
    <h4>{{trans('backend.needyourpasswordtocontinue')}}</h4>
    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label($passwordprivilege, trans('livecms.'.$passwordprivilege), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9">
            {!! Form::password($passwordprivilege, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
            <h5>{{Str::ucfirst($errors->first($passwordprivilege))}}</h5>
        </div>
    </div>
    @else
    <h4>Terjadi error</h4>
    @endif
    <ul class="list-unstyled">
        @foreach ($errors->all() as $error)
            @if (! str_contains($error, trans('livecms.'.$passwordprivilege)))
            <li>{{ Str::ucfirst($error) }}</li>
            @endif
        @endforeach
    </ul>
</div>
@endif
