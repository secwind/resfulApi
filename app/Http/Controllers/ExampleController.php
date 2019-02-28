<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index()
    {
        $projects = Project::all();


        return view('projects.index', compact('projects'));
    }

    public function show (Project $project)
    {
        return view('/projects.show', compact('project'));    
    } // ------  / show 

    public function create ()
    {
        return view('projects.create'); 
    } // -----  / create 

    public function store ()
    {
        $data = request(['title', 'body']);
        Project::create($data);

        // Project::create([
     //        'title' => request('title'),
     //        'body' => request('body'),
     //    ]);


        return redirect('/projects');
    } // ------  / store 

    public function edit (Project $project)
    {
        return view('projects.edit', compact('project'));   
    } // ------  / edit 

    public function update (Project $project)
    {
        $data = request(['title', 'body']);
        $project->update($data);

        return redirect('/projects');  
    } // ------  / update 

    public function destroy (Project $project)
    {
        $project->delete();
        // Project::findOrFail($id)->delete();
        return redirect('/projects');  
    } // ------  / destroy 
}
