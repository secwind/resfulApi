<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home() 
    {
        return view('test.test',[
            'datas' => [
                'One',
                'Two',
                'Three',
                'Four',
            ],
            'res' => request('title'),
        ]);
    }

    public function about() 
    {
        return view('test.about')
        ->withWisanu('My Name SecWind');
    }

}
