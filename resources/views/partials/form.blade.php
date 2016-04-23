<div class="row">
	<div class="col-md-{{ $width or '7' }}">
		<div class="box">
		  	<div class="box-body">
				{!! Form::model($model, ['method' => !isset($params['id']) ? 'post' : 'put', 'url' => action($baseClass.'@'.$action, !isset($params) ? [] : $params), 'files' => isset($files) ?: false, 'id' => $base.'form']) !!}
				
				@yield('form')

				@if (!isset($withoutFormButtons))
				<hr>
				
				<div class="row form-group">
					<div class="col-md-{{ $formLeftWidth or '3' }}">&nbsp;</div>
					<div class="col-md-9">
						{!! Form::submit('Simpan', ['class' => 'btn btn-success']) !!}
						<a href="{{ action($baseClass.'@index') }}" class="btn btn-default">Batal</a>
					</div>
				</div>
				@endif

				{!! Form::close() !!}
		  	</div><!-- /.box-body -->
		</div><!-- /.box-->
	</div>
</div>