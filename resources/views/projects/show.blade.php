@extends('projects.master.layout')

@section('title', 'Project Show')


@section('content')
	<h1 class="title">Show Project</h1><hr>

	<h3>{{ $project->title }}</h3>
	<p>{{ $project->body }}</p>
	<p>
		<a href="/projects/{{ $project->id}}/edit">Edit</a>
	</p><hr>

	<!-- Start /Show Tasks -->
	<div class="card">
		<div class="card-body">
			<h2>Show Tasks Table</h2><br>
			@if ($project->tasks->count())
				@foreach ($project->tasks as $task)
					<form method="POST" action="/completed-tasks/{{ $task->id }}">
						@if ($task->completed)
							@method('DELETE')
						@endif
						@csrf
						
						<div class="form-group row">
							<div class="col-sm-10">
								<div class="checkbox">
									<label class="{{ $task->completed ? 'is-text-complete' : '' }}">
										<input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>  
										{{ $task->body }}
									</label>
								</div>
							</div>
						</div>
					</form>		
				@endforeach
			@endif
		</div>
	</div><!-- End /Show Tasks -->

	<!-- Start /form New Tasks -->		
	<div class="card">
		<form class="card-body" method="POST" action="/projects/{{ $project->id}}/tasks">
			@csrf
			
			@include('forms.input', [
				'name' => 'body', 
				'placeholder' => 'New Tasks Enter...', 
				'value' => '', 
				'label' => 'New Tasks',
				'required' => 'required',
				]
			)
			<button type="submit" class="btn btn-outline-primary">Create Task</button>
		</form>
	</div><!-- End /form New Tasks -->
	
	
	@include('forms.errors')

	
@endsection