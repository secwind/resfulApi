<?php

namespace App\Http\Controllers\Invoice;

use App\Model\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class InvoiceSellerController extends ApiController
{

    public function index(Invoice $invoice)
    {
        $seller = $invoice->seller;
        return $this->showOne($seller);
    }


}
