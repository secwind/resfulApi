<?php

namespace App\Http\Controllers\Invoice;

use App\Model\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class InvoiceBuyerController extends ApiController
{

    public function index(Invoice $invoice)
    {
        //$buyer = $invoice->seller;
        $buyer = $invoice->buyer;
        return $this->showOne($buyer);
    }

}
