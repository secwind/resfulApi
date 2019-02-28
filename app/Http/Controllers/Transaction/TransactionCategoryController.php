<?php

namespace App\Http\Controllers\Transaction;

use App\Model\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TransactionCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {

        // $categories = $transaction->product;
        $categories = $transaction->product->categories;
        // 1. เอา ไอของ Transaction มาดูว่าเป็น Product id ที่เท่าไหร่  $this->belongsTo(Product::class);
        // ความเป็นจริงมันที่ $product->categories **วามหมายคือ 1 product มีหลาย categories

        // dd($categories);
        return $this->showAll($categories);
    }


    public function show(Transaction $transaction)
    {
        //
    }


}
