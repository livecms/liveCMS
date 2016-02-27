@extends('backend')

@section('content')
<h4>
@if(isset($withoutAddButton))
@else
	<a href="{{ action($baseClass.'@getTambah') }}" class="btn btn-sm btn-success">Tambah</a> <small>Klik untuk menambah data {{ snakeToStr($base) }}.</small>
@endif
</h4>
<div class="box">
  	<div class="box-body">
		<table class="table datatables">
			<thead>
			@foreach(array_values($fields) as $field)
				<th>{{ $field }}</th>
			@endforeach
				<th>Menu</th>
			</thead>
		</table>  	  	
  	</div><!-- /.box-body -->
</div><!-- /.box-->
@stop