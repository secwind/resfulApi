<?php

namespace App\Model;

use App\User;
use App\Model\Buyer;
use App\Model\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $dates = ['daleted_at'];
    protected $fillable = [
    	'quantity',
    	'buyer_id',
    	'product_id',
    ];

    public function buyer ()
    {
    	return $this->belongsTo(Buyer::class);	
    } // ------  / buyer 

    public function product ()
    {
    	return $this->belongsTo(Product::class);	
    } // ------  / product 

    public function users ()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    } // ------  / users
}
