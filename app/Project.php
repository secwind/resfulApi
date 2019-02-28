<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // protected $fillable = [
    // 	'title', 'body'
    // ];

    protected $guarded = [];


    public function tasks ()
    {
    	return $this->hasMany(Task::class);	
    } // ------  / tasks 
    
    public function addTask ($playload)
    {
    	$this->tasks()->create($playload);
	
    } // ------  / addTask 

    public function isActive ($payload)
    {
        $this->update([$payload => true]);   
    } // ------  / isActive 

    public function noActive ($payload)
    {
        $this->update([$payload => false]);   
    } // ------  / isActive 

}
