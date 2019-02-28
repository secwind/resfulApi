<?php

namespace App\Http\Controllers\Category;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategorySellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $sellers = $category->products()
            ->with('transactions.buyer.invoices')
            ->with('seller')
            ->get()
            ->pluck('seller')
            ->unique()
            ->values();
        return $this->showAll($sellers);    
    }

}
