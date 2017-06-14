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
        $category_id = $request->input('cid', 1);
        $categorys = Category::all();
        $products = Product::where('category_id', $category_id)->get();
        return view('home.index')->with('categorys', $categorys)
            ->with('products', $products)
            ->with('active', $category_id);
    }

    public function getShoppingcar()
    {
        $items = Cart::getContent();
        return view('home.shoppingcar')->with('items', $items);
    }

    public function getOrdsn(Request $request)
    {
        if (Cart::isEmpty()) {
            return '<script>alert("还没加入购物车");location.href = "/home/index";</script>';
        }
        $ids = explode(',', $request->input('id', ''));
        $items = [];
        for ($i = 0; $i < count($ids); $i++) {
            $items[$i] = Cart::get($ids[$i]);
        }
        return view('home.ordsn')->with('items', $items)
            ->with('total', Cart::getTotal());
    }

    public function getWxpay()
    {
        return view('home.wxpay');
    }
}