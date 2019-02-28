<?php

namespace App\Http\Controllers\Buyer;

use App\User;
use App\Model\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerInvoiceController extends ApiController
{

    /// ตัวแปลตัวเป็น $buyer เท่านั้น
    public function index(User $buyer)
    {
        $invoices =   $buyer->invoices;

        return $this->showAll($invoices);
    }



}
