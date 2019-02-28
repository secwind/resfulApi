<?php

namespace App\Model;

use App\Model\Seller;
use App\Model\Invoice;
use App\Model\Category;
use App\Model\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['daleted_at'];
	const AVAILABLE_PRODUCT = 'available';
	const UNAVAILABLE_PRODUCT = 'unavailable';
    protected $fillable = [
    	'name',
    	'description',
    	'quantity',
    	'status',
    	'image',
    	'seller_id'
    ];
    protected $hidden = [
        'pivot'
    ];

    public static function boot()
    {
        // static::creating(function ($model) {
        //     // blah blah
        // });

        static::updating(function ($product) {
            if ($product->quantity == 0 && $product->isAvailable()) {
                $product->status = Product::UNAVAILABLE_PRODUCT;
                $product->save();
            }
        });

        // static::deleting(function ($model) {
        //     // bluh bluh
        // });
        
        parent::boot();
    }

    public function isAvailable ()
    {
    	return $this->status == Product::AVAILABLE_PRODUCT;	
    } // ------  / isAvailable 

    public function categories ()
    {
        return $this->belongsToMany(Category::class);       
    } // ------  / categories 

    public function seller ()
    {
        return $this->belongsTo(Seller::class);      
    } // ------  / seller 

    public function transactions ()
    {
        return $this->hasMany(Transaction::class);    
    } // ------  / transactions 

    public function invoices ()
    {   
        return $this->hasMany(Invoice::class);      
    } // ------  / invoice 
}
