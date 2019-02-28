<?php

namespace App\Http\Controllers\Invoice;

use App\User;
use App\Model\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class InvoiceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();
        return $this->showAll($invoices);
    }


    public function show(Invoice $invoice)
    {
        return $this->showOne($invoice);
    }

  
}
