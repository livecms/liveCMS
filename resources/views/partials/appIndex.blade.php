@extends('backend')

@section('content')
<div class="row">
	<div class="col-md-8">
	@if(isset($withoutAddButton))
	@else
		<a href="{{ action($baseClass.'@create', request()->query()) }}" class="btn btn-sm btn-success">Tambah</a> <small>Klik untuk menambah data {{ trans('livecms.'.$base) }}.</small>
	@endif
	</div>
	<div class="col-md-4 row">
		<div class="col-xs-12 visible-xs visible-sm">&nbsp;</div> 
		@yield('index.submenu')
	</div>
</div>
<h4>
</h4>
<div class="box">
  	<div class="box-body">
		<table class="table datatables display responsive no-wrap">
			<thead>
			@foreach(array_values($fields) as $field)
				<th>{{ trans('livecms.'.strtolower($field)) }}</th>
			@endforeach
				<th>Menu</th>
			</thead>
		</table>  	  	
  	</div><!-- /.box-body -->
</div><!-- /.box-->
@stop