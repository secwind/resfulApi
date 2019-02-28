<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $guarded = [];
    public function project ()
    {
    	return $this->belongsTo(Project::class);	
    } // ------  / project 

    public function complete ($payload)
    {
    	$this->update([$payload => true]);	
    } // ------  / complete 

    public function incomplete ($payload)
    {
    	$this->update([$payload => false]);	
    } // ------  / incomplete 
}
