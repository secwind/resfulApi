<?php

namespace App\Http\Controllers\Buyer;

use App\Model\Buyer;
use App\Model\Product;
use App\Model\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        // $products1 = Transaction::where('buyer_id', $buyer->id)
        //     ->with('product')
        //     ->with('buyer')
        //     ->get();
            // เกือบคล้าแต่ไม่เหมือนกัน
        $products = $buyer->transactions()
            ->with('product')
            ->with('buyer')
            ->get()
            ->pluck('product')
            ->unique('id')
            ->values();
            //   ->pluck('product'); คือเลือกให้แสดงแค่ข้อมูลของ product

        return $this->showAll($products);
        //ให้ค้นหาว่า buyer Id5 มีกี่ trasaction อะไรบ้าง และในนั้นคือ product อะไร
    }

}
