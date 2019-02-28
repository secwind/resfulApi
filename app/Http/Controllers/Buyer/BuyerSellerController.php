<?php

namespace App\Http\Controllers\Buyer;

use App\Model\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        //กำลังบอกว่า Id5 เนี๊ยได้ซื้อของกับเซลคนไหนไปบ้าง ใดยid ไม่ซ้ำกัน
        $sellers =  $buyer->transactions()
                    ->with('product.seller')
                    ->get()
                    ->pluck('product.seller')
                    ->unique('id')
                    ->values();

           // foreach ($sellers as $seller) {
           //             $data[] = [
           //              'id' => $seller->id,
           //              'seller' => $seller->product->seller->name,
           //             ];
           //          }     

           //return response()->json(['data'  => $data]); 
        return $this->showAll($sellers);            
    }

}
            