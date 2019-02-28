<?php

namespace App\Model;

use App\User;
use App\Model\Product;
use App\Scopes\SellerScope;
use Illuminate\Database\Eloquent\Model;

class Seller extends User
{
	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new SellerScope);
	}

    public function products()
    {
    	return $this->hasMany(Product::class);
    } // ------  / products 

}
