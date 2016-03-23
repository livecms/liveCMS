<div class="row">
	<div class="col-md-{{ $width or '7' }}">
		<div class="box">
		  	<div class="box-body">
				{!! Form::model($model, ['method' => !isset($params) ? 'post' : 'put', 'url' => action($baseClass.'@'.$action, !isset($params) ? null : $params) ]) !!}
				
				@yield('form')

				<div class="row form-group">
					<div class="col-md-3">&nbsp;</div>
					<div class="col-md-9">
						{!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
						<a href="{{ action($baseClass.'@index') }}" class="btn btn-danger">Batal</a>
					</div>
				</div>

				{!! Form::close() !!}
		  	</div><!-- /.box-body -->
		</div><!-- /.box-->
	</div>
</div>