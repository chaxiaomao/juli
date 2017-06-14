<?php
namespace App\Http\Controllers\View\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Cart;

class indexController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
    public function getIndex(Request $request)
    {
        $category_id = $request->input('cid', '');
        $categorys = Category::all();
        $products = Product::where('category_id', $category_id == ''? 1 : $category_id)->get();
        return view('home.index')->with('categorys', $categorys)
            ->with('products', $products)
            ->with('active', $category_id);
    }

    public function getShoppingcar()
    {
        $cart_items = Cart::getContent();
        return view('home.shoppingcar')->with('cart_items', $cart_items);
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