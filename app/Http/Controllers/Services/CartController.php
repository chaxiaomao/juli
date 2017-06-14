<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Tool\dataPusher;

class CartController extends Controller
{
    public function productAdd(Request $request)
    {
        $arr = $request->input('data', '');
        $data_push = new dataPusher();
        if (count($arr) == 0) {
            $data_push->status = 1;
            $data_push->message = "请先选择商品";
        }
        for ($i = 0; $i < count($arr); $i++) {
            Cart::add($arr[$i][0], $arr[$i][1], $arr[$i][2], 1, array('preview' => $arr[$i][3]));
        }
        $data_push->status = 0;
        $data_push->message = "添加成功";
        return $data_push->toJson();
    }

}