<?php



Route::get('/', function () {
    return view('welcome');
});

//  Start Test 
Route::get('/test', 'PageController@home');
Route::get('/about', 'PageController@about');

/*
	GET /projects (index)
	GET /projects/1 (show)
	GET /projects/create (create)
	POST /projects (store)
	GET /projects/1/edit (edit)
	PATH /projects/1 (update)
	DELETE /projects/1 (destroy)
*/

	Route::resource('/projects', 'ProjectController');

	Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');

	Route::post('/completed-tasks/{task}', 'CompletedTasksController@store');
	Route::delete('/completed-tasks/{task}', 'CompletedTasksController@destroy');
//  End Test 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
