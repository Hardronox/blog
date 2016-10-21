<?php

namespace App\Http\Controllers;

use App\Blogs;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abc='bijktch';
        $orders=['1','2','asdf'];
        //$blogs= Blogs::all();
        //var_dump($blogs[0]->category);
        return view('home',['abc'=>$abc, 'orders'=> $orders]);
    }
}
