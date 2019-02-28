<?php

namespace App\Http\Controllers\Seller;

use App\User;
use App\Model\Seller;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;

class SellerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $products = $seller->products;
        //return $products->count();
        return $this->showAll($products);
    }

    public function store (Request $request, User $seller)
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image',
        ],[
            'name.required' => 'กรุณาใส่ชื่อ',
            'quantity.integer' => 'กรุณาใสข้อมูลเป็นตัวเลข',
        ]); 

        $data['status'] = Product::UNAVAILABLE_PRODUCT;
        $data['image'] = $request->image->store('');
        $data['seller_id'] = $seller->id;

        // dd($data);
        $product = Product::create($data);

        return $this->showOne($product);
    } // ------  / store 

    public function update (Request $request, Seller $seller, Product $product)
    {
        // dd('sadnasind');
        $data = request()->validate([
            'quantity' => 'integer|min:1',
            'status' => 'in:'. Product::AVAILABLE_PRODUCT . ',' . Product::UNAVAILABLE_PRODUCT,
            // 'image' => 'image',
        ]);

        //ถ้า sellerID = 1 แต่ใน $product.seller_id ไม่เท่ากับ 1 ให้เกิน if
        $this->checkSeller($seller, $product); 

        $product->fill(
            $request->only([
            'name', 'description', 'quantity'
            ]
        ));     

        if ($request->has('status')) {
            $product->status = $request->status;

            if ($product->isAvailable() && $product->categories()->count() == 0) {
                return $this->errorResponse('ตรวจสอบเห็นว่ามาบางอย่างผิดพลาด', 409);
            }
        }

        if ($request->hasFile('image')) {
            Storage::delete($product->image);

            $product->image = $request->image->store('');
        }

        if ($product->isClean()) {
            return $this->errorResponse('พบตรวจสอบว่าข้อมูลไม่มีการเปลี่ยนแปลง', 422);
        }
        $product->save();

        return $this->showOne($product);
    } // ------  / update 

    public function destroy (Seller $seller, Product $product)
    {
        $this->checkSeller($seller, $product);   
        $product->delete();
        Storage::delete($product->image);
        return $this->showOne($product);
    } // ------  / destroy 

    protected function checkSeller(Seller $seller, Product $product)
    {
        //ถ้า sellerID = 1 แต่ใน $product.seller_id ไม่เท่ากับ 1 ให้เกิน if
        if ($seller->id != $product->seller->id) {
            throw new HttpException(422,"Error Seller is not math Product.seller_id");
        }
    }

}
