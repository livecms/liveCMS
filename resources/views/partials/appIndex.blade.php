@extends('backend')

@section('content')
<div class="row">
	<div class="col-md-8">
	@if(isset($withoutAddButton))
	@else
		<p>
		<a href="{{ action($baseClass.'@create', request()->query()) }}" class="btn btn-danger">Tambah</a> &nbsp;<span>Klik untuk menambah {{ trans('livecms.'.$base) }}.</span>
		</p>
	@endif
	</div>
	<div class="col-md-4 row">
		<div class="col-xs-12 visible-xs visible-sm">&nbsp;</div> 
		@yield('index.submenu')
	</div>
</div>
<h4>
</h4>
<div class="row">
    <div class="col-sm-12">
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