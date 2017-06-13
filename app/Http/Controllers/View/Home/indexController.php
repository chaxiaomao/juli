<?php
namespace App\Http\Controllers\View\Home;

use App\Http\Controllers\Controller;

class indexController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
    public function getIndex()
    {
        return view('home.index');
    }

    public function getShoppingcar()
    {
        return view('home.shoppingcar');
    }

    public function getOrdsn()
    {
        return view('home.ordsn');
    }

    public function getWxpay()
    {
        return view('home.wxpay');
    }
}