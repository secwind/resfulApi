<?php

namespace App\Model;

use App\User;
use App\Model\Invoice;
use App\Model\Transaction;
use App\Scopes\BuyerScope;
use Illuminate\Database\Eloquent\Model;

class Buyer extends User
{
	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new BuyerScope);
	}

    public function transactions ()
    {
    	return $this->hasMany(Transaction::class);	
    } // ------  / transactions 

}
