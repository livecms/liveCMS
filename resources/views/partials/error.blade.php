@if($errors->any())
<div class="alert alert-warning">
	<h4>Terjadi error</h4>
	<ul class="list-unstyled">
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif