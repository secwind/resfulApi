@extends('projects.master.layout')

@section('title', 'Title') {{-- Title Name --}}


@section('content')
	<h1>Home Project</h1>

	<ul>
		@foreach ($projects as $project)
		<li>Title : 
			<a href="/projects/{{$project->id}}">
				{{ $project->title }}
			</a>
		</li>
		@endforeach
	</ul>

@endsection


