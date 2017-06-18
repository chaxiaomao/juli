<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Tool\dataPusher;

class productController extends Controller
{
    public function getStop()
    {
        $data_pusher = new dataPusher();
        if (count(Product::where('status', 0)->get()) == 1) {
            $data_pusher->status = 1;
            $data_pusher->message = "至少保留一个商品";
            return $data_pusher->toJson();
            exit;
        }
        $product = Product::find($_GET['id']);
        $product->status = 1;
        $product->save();
        $data_pusher->status = 0;
        $data_pusher->message = "已下架";
        return $data_pusher->toJson();
    }

    public function getStart()
    {
        $data_pusher = new dataPusher();
        $product = Product::find($_GET['id']);
        $product->status = 0;
        $product->save();
        $data_pusher->status = 0;
        $data_pusher->message = "已上架";
        return $data_pusher->toJson();
    }

}