<?php

namespace App\Model;

use App\Model\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

	protected $dates = ['daleted_at'];
    protected $fillable = [
        'name',
        'description',
    ];

    protected $hidden = [
        'pivot'
    ];

    public function products ()
    {
    	return $this->belongsToMany(Product::class);	
    } // ------  / products 
}
