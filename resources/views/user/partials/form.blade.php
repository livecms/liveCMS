{!! Form::model($model, ['method' => !isset($params['id']) ? 'post' : 'put', 'url' => action($baseClass.'@'.$action, !isset($params) ? [] : $params), 'files' => isset($files) ?: false, 'id' => $base.'form', 'class' => 'form-horizontal']) !!}
                
@yield('form')

<div class="row form-group">
    <div class="col-sm-2">&nbsp;</div>
    <div class="col-sm-10">
        {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
        <a href="{{ action($baseClass.'@index') }}" class="btn btn-danger">Batal</a>
    </div>
</div>

{!! Form::close() !!}