<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Cart;

class orderController extends Controller
{
    public function postCommit(Request $request)
    {
        $user = session()->get('user');
        $ids = explode(',', $request->input('ids', ''));
        $receiver = $request->input('receiver', '');
        $tel = $request->input('tel', '');
        $city = $request->input('city', '');
        $location = $request->input('location', '');
        if (!$user) {
            return '<script>alert("登陆过期，请重新登陆");history.go(-1);</script>';
            exit;
        }
        if ($receiver == '') {
            return '<script>alert("请填写收货人姓名");history.go(-1);</script>';
            exit;
        }
        if ($tel == '') {
            return '<script>alert("请填写收货人手机");history.go(-1);</script>';
            exit;
        }
        if ($city == '') {
            return '<script>alert("请选择城市");history.go(-1);</script>';
            exit;
        }
        if ($location == '') {
            return '<script>alert("请填写收货地址");history.go(-1);</script>';
            exit;
        }
        $items = [];
        for ($i = 0; $i < count($ids); $i++) {
            $items[$i] = Cart::get($ids[$i]);
        }
        $ordsn = "J" . date('Ymd') . time();//订单编号
        $order = new Order();
        $order->user_id = $user['user_id'];
        $order->ordsn = $ordsn;
        $order->receiver = $receiver;
        $order->tel = $tel;
        $order->city = $city;
        $order->location = $location;
        $order->fast_shot = json_encode($items);
        $order->save();
        return redirect('/home/wxpay/' . $order->id);
    }
}