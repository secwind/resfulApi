@if ($errors->any())
<div class="alert alert-danger" style="margin: 1em;">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif