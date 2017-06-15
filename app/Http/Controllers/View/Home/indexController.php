<?php
namespace App\Http\Controllers\View\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\user;
use Cart;
use App\Tool\WxPay\Business;
use App\Tool\WxPay\Payment;
use App\Tool\WxPay\Order as wxOrder;
use App\Tool\WxPay\UnifiedOrder;

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
            ->with('ids', $request->input('id', ''))
            ->with('total', Cart::getTotal());
    }

    public function getPersonal(Request $request)
    {
        if (!$request->session()->get('user')) {
            return '<script>alert("登陆过期，请重新登陆");location.href = "/user/login";</script>';
        }
        $user = User::find($request->session()->get('user.user_id'));
        if ($user->phone == null) {
            return '<script>alert("请先注册手机号码");location.href = "/user/register";</script>';
        }
        return view("home.personal")->with('user', $user);
    }

    public function getWxpay(Request $request)
    {
        $user = session()->get('user');
        if (!$user) {
            return '<script>alert("登陆过期，请重新登陆");location.href = "/home/login";</script>';
        }
        $id = $request->input('id', '');
        $order = Order::find($id);
        $items = json_decode($order->fast_shot);
        $total = '';
        foreach ($items as $item) {
            $total += $item->price;
        }
        $business = new Business(
            env('WECHAT_APPID'),
            env('WECHAT_SECRET'),
            env('MERCHANT_ID'),
            env('MERCHANT_KEY')
        );
//        $order = new Order();
//        $order->body = 'grocery business';
//        $order->out_trade_no = $ordsn;
//        $order->total_fee = $total * 100;    // 单位为 “分”, 字符串类型
//        $order->openid = $wechat_user['id'];
//        $order->notify_url = url('service/wx_notify');
//        $unifiedOrder = new UnifiedOrder($business, $order);
//        $payment = new Payment($unifiedOrder);
        return view('home.wxpay')->with('items', $items)
            ->with('total', $total);
    }
}