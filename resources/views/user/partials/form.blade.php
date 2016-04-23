{!! Form::model($profile, ['method' => !isset($params['id']) ? 'post' : 'put', 'url' => action($baseClass.'@'.$action, !isset($params) ? [] : $params), 'files' => isset($files) ?: false, 'id' => $base.'form', 'class' => 'form-horizontal']) !!}
                
@yield(isset($form) ? $form : 'form')
<hr>
<div class="row form-group">
    <div class="col-sm-2">
        {!! Form::submit('Update', ['class' => 'btn btn-block btn-success']) !!}
    </div>
    <div class="col-sm-10">
        <span class="text-muted"> 
        {{trans('backend.clicktoupdate')}}
        </span>
    </div>
</div>

{!! Form::close() !!}