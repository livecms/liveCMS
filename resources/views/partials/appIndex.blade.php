@extends('backend')

@section('content')
<h4>
	<a href="{{ action($baseClass.'@getTambah') }}" class="btn btn-sm btn-success">Tambah</a> <small>Klik untuk menambah data {{ $base }}.</small>
</h4>
<div class="box">
  	<div class="box-body">
		<table class="table datatables">
			<thead>
			@if(isset($datatablesFields))
		     	@foreach($datatablesFields as $field)
				<th>{{ $field }}</th>
				@endforeach
		    @else
				@foreach($fields as $field)
				<th>{{ ucwords(implode(' ', explode('_', $field))) }}</th>
				@endforeach
			@endif
				<th>Menu</th>
			</thead>
		</table>  	  	
  	</div><!-- /.box-body -->
</div><!-- /.box-->
@stop