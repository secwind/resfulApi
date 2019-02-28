<?php

namespace App\Http\Controllers\Buyer;
use App\User;
use App\Model\Buyer;
use App\Model\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ให้ค่า Table transactions ว่า buyer_id ตรงกับ user.id ใครบ้าง
        $buyers = Buyer::has('transactions')->get();
        //$buyers = Transaction::has('users')->get();
        // dd( $buyers);
        $i = 1;
        foreach ($buyers as $buyer) {
            $data[] = [
            'number' =>   $i++,
            'id' => $buyer->id,
            'name' => $buyer->name,
            ];
        }
        return $this->showAll($buyers);
    }

    public function show (Buyer $buyer)
    {
        //$buyer = Buyer::has('transactions')->findOrFail($id);
        // $buyer = $transactions->users();
        
        return $this->showOne($buyer);
    } // ------  / show 
}
