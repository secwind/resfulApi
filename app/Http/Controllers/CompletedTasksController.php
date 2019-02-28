<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class CompletedTasksController extends Controller
{
    public function store (Task $task)
    {
    	$task->complete('completed');
    	return back();	
    } // ------  / store

    public function destroy (Task $task)
     {
     	$task->incomplete('completed');
     	return back();	
     } // ------  / destroy  
}
