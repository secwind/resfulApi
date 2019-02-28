<?php

namespace App\Http\Controllers\Invoice;

use App\Model\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class InvoiceProductController extends ApiController
{

    public function index(Invoice $invoice)
    {
        $product = $invoice->product()->with('seller')->get();
        //return $this->showOne($product);
        return $this->showAll($product);
    }


}
