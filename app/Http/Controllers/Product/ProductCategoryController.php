<?php

namespace App\Http\Controllers\Product;

use App\Model\Product;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductCategoryController extends ApiController
{

    public function index(Product $product)
    {
        $categories = $product->categories;
        return $this->showAll($categories);
    }


    public function update (Request $request,Product $product, Category $category)
    {
        $item = $category->id;
        //attach **  sync ** syncWithoutDetaching ** detach
        $product->categories()->syncWithoutDetaching([$item]);

        return $this->showAll($product->categories);    
    } // ------  / update 
    

    public function destroy (Product $product, Category $category)
    {
        $item = $category->id;
        if (!$product->categories()->find($item)) {
              return $this->errorResponse('ตรวจสอบไม่พอข้อมูลที่ต้องการDelete', 404);
        }

        $product->categories()->detach([$item]);
        return $this->showAll($product->categories); 
    } // ------  / destroy 

}
