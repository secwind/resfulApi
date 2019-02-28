<?php

namespace App\Http\Controllers\Category;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoryInvoiceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $invoices = $category->products()
            ->whereHas('invoices')
            ->with('invoices')
            ->get()
            ->pluck('invoices')
            ->collapse();
            return $this->showAll($invoices);
    }

}
