<?php
namespace App\Http\Controllers\View\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Delivery;

class orderController extends Controller
{
    public function getList()
    {
        $orders = Order::all()->sortByDesc('created_at');
        return view('admin.order_list')->with('orders', $orders);
    }

    public function getUndeal()
    {
        $orders = Order::where('send', 1)->get()->sortByDesc('created_at');
        return view('admin.order_list')->with('orders', $orders);
    }

    public function getDeal()
    {
        $orders = Order::where('send', 0)->get()->sortByDesc('created_at');
        return view('admin.order_list')->with('orders', $orders);
    }

    public function getEdit()
    {
        $order = Order::find($_GET['id']);
        $items = json_decode($order->fast_shot);
        return view('admin.order_edit')->with('order', $order)
            ->with('items', $items);
    }

    public function postEdit()
    {
        $waybill = $_POST['waybill'];
        if ($waybill == '') {
            return '<script>alert("请填写运单号");var index = parent.layer.getFrameIndex(window.name);parent.layer.close(index);</script>';
            exit;
        }
        $order = Order::find($_POST['id']);
        if ($order->delivery) {
            Delivery::where('order_id', $_POST['id'])->first()->update(['waybill' => $waybill]);
            $order->send = 0;
            $order->save();
            return '<script>alert("修改成功");parent.location.reload();</script>';
            exit;
        }
        $delivery = new Delivery();
        $delivery->order_id = $order->id;
        $delivery->waybill = $waybill;
        $delivery->save();
        $order->send = 0;
        $order->save();
        return '<script>alert("修改成功");parent.location.reload();</script>';
    }
}