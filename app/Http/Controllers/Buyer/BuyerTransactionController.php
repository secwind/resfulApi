<?php

namespace App\Http\Controllers\Buyer;

use App\Model\Buyer;
use App\Model\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        //$transactions = Transaction::where('buyer_id', $buyer->id)->get();
     
        $transactions = $buyer->transactions;
        
        return $this->showAll($transactions);
    }

}
