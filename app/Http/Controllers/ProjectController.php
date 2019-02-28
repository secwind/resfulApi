<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    function __construct()
    {
        $this->middleware('auth')->except(['show']);
        // $this->middleware('auth')->only(['store', 'updat', 'destroy']);
    }
    public function index()
    {

    	$projects = Project::where('owner_id', auth()->id())->get();


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
        // $test = request('title') == 'Wisanu'? 'Yes': 'No';
        // dd($test);
        $attributes = request()->validate([
            'title' => ['required', 'min:3'], 
            'body' => ['required', 'min:3']
        ]);
        $attributes['owner_id'] = auth()->id();
        
        Project::create($attributes);

    	return redirect('/projects');
    } // ------  / store 

    public function edit (Project $project)
    {
        //dd($project->get());
    	return view('projects.edit', compact('project'));	
    } // ------  / edit 

    public function update (Project $project)
    {
        $data = request()->validate([
            'title' => ['required', 'min:3'], 
            'body' => ['required', 'min:3'], 
        ]);
        $project->update($data);

        return redirect('/projects');  
    } // ------  / update 

    public function destroy (Project $project)
    {
        $project->delete();
        // Project::findOrFail($id)->delete();
        return redirect('/projects');  
    } // ------  / destroy 


    // $project->update($this->validateProject());
    protected function validateProject()
    {
        return request()->validate([
            'title' => ['required', 'min:5'],
            'description' => 'required'
        ]);
    }

}


