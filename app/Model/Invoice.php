<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
     use SoftDeletes;

    protected $dates = ['daleted_at'];
    protected $fillable = [
    	'quantity',
    	'buyer_id',
    	'seller_id',
    	'product_id',
    ];

    public function buyer ()
    {
    	return $this->belongsTo(User::class, 'buyer_id');	
    } // ------  / buyer 

    public function seller ()
    {
        return $this->belongsTo(User::class, 'seller_id');       
    } // ------  / seller 

    public function product ()
    {
    	return $this->belongsTo(Product::class);	
    } // ------  / product 



}
