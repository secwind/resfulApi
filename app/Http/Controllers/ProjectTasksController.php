<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
	public function store (Project $project)
	{
		$project->addTask(
			request()->validate([
				'body' => 'required|min:2'
			])
		);

		return back();	
	} // ------  / store 

}
