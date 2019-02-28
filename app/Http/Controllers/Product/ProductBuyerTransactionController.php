<?php

namespace App\Http\Controllers\Product;

use App\User;
use App\Model\Product;
use App\Model\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class ProductBuyerTransactionController extends ApiController
{
    public function store (Request $request, Product $product, User $buyer)
    {
        $request->validate([

            'quantity' => 'required|integer|min:1',
        ],[
            'quantity.required' => 'กรุณากรอกจำนวนสินค้า',
            'quantity.integer' => 'กรุณากรอกข้อมูลเป็นตัวเลขเท่านั้น',
            'quantity.min' => 'จำนวนต้องมากกว่า 0',
        ]); 

        // ถ้าผู้ซื้อกับผู้ขายมี id ที่ตรงกัน
        if ($buyer->id == $product->seller_id) {
            return $this->errorResponse('ผู้ซื้อกับผู้ขายมี id ที่ตรงกัน', 409);
        }

        // if (!$buyer->isVerified()) {
        //     return $this->errorResponse('ผู้ซื้อยังไม่ได้รับการตรวจสอบ isNotVerified', 409);
        // }

        // if (!$product->seller->isVerified()) {
        //     return $this->errorResponse('ผู้ขายยังไม่ได้รับการตรวจสอบ isNotVerified', 409);
        // }

        if (!$product->isAvailable()) {
            return $this->errorResponse('Product :: ไม่สามารถใช้สินค้า lot นี้ได้เนื่องจากหมดแล้ว', 409);
        }

        if ($product->quantity < $request->quantity) {
            return $this->errorResponse('Product :: มีน้อยกว่าจำนวนที่ร้องขอ ', 409);
        }

        return DB::transaction(function() use ($request, $product, $buyer){
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id,
            ]);

            return $this->showOne($transaction);
        });


        
    } // ------  / store 
}
