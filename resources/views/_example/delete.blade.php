@extends('projects.master.layout')

@section('title', 'EditTitle')


@section('content')
	<h1 class="title">Deleted Project</h1>

	<form method="POST" action="/projects/{{-- {{ $projects->id }} --}}">
		@method('PATCH') @csrf
		<fieldset class="form-group">
			<label for="exampleInputEmail1">Title</label>
			<input 
				name="title"
				type="text" class="form-control" 
				id="exampleInputEmail1" 
				placeholder="Title"
				value="{{-- {{ $projects->title }} --}}" 
			>
		</fieldset>

		<fieldset class="form-group">
			<label for="exampleTextarea">Body</label>
			<textarea name="body" class="form-control" rows="3">{{-- {{ $projects->body }} --}}</textarea>
		</fieldset>


		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

	
@endsection