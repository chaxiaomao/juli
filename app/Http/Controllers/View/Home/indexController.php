<?php
namespace App\Http\Controllers\View\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Address;
use Cart;
use App\Tool\WxPay\Business;
use App\Tool\WxPay\Payment;
use App\Tool\WxPay\Order as wechatOrder;
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
        $categorys = Category::where('status', 0)->get();
        $products = Product::where(['category_id' => $category_id, 'status' => 0])->get();
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
            return '<script>alert("还没加入购物车");location.href = "/at/home/index";</script>';
        }
        $user = $request->session()->get('user');
        $ids = explode(',', $request->input('id', ''));
        $items = [];
        $total = 0;
        for ($i = 0; $i < count($ids); $i++) {
            $items[$i] = Cart::get($ids[$i]);//查询商品
            $total += Cart::get($ids[$i])->getPriceSum();//计算总数
        }
        $addres = Address::find($user['user_id']);
        return view('home.ordsn')->with('items', $items)
            ->with('ids', $request->input('id', ''))
            ->with('total', $total)
            ->with('addres', $addres);
    }

    public function getPersonal(Request $request)
    {
        $user = User::find($request->session()->get('user.user_id'));
        if ($user->phone == null) {
            return '<script>alert("请先注册手机号码");location.href = "/user/register";</script>';
        }
        return view("home.personal")->with('user', $user);
    }

    public function getOrders(Request $request)
    {
        $user = $request->session()->get('user');
        $orders = Order::where('user_id', $user['user_id'])->get();
        return view('home.orders')->with('orders', $orders);
    }

    public function getOrder($id)
    {
        $order = Order::find($id);
        $items = json_decode($order->fast_shot);
        return view('home.order')->with('items', $items)
            ->with('order', $order);
    }

    public function getAddress()
    {
        return view('home.address');
    }

    public function getWxpay(Request $request, $id)
    {
        $user = session()->get('user');
        $order = Order::find($id);
        $items = json_decode($order->fast_shot);
//        $total = 0;
//        foreach ($items as $item) {
//            $total += $item->price;
//        }
        $business = new Business(
            env('WECHAT_APPID'),
            env('WECHAT_SECRET'),
            env('MERCHANT_ID'),
            env('MERCHANT_KEY')
        );
        $wxorder = new wechatOrder();
        $wxorder->body = 'grocery business';
        $wxorder->out_trade_no = $order->ordsn;
        $wxorder->total_fee = $order->total * 100;    // 单位为 “分”, 字符串类型
        $wxorder->openid = $user['wechat']['id'];
        $wxorder->notify_url = url('/service/wechat/pay_callback');
        $unifiedOrder = new UnifiedOrder($business, $wxorder);
        $payment = new Payment($unifiedOrder);
        return view('home.wxpay')->with('items', $items)
            ->with('total', $order->total)
            ->with('payconfig', json_encode($payment));
    }
}