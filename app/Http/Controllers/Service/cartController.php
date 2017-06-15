<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Tool\dataPusher;

class cartController extends Controller
{
    public function getAdd(Request $request)
    {
        $arr = $request->input('data', '');
        $data_push = new dataPusher();
        if ($arr == "") {
            $data_push->status = 1;
            $data_push->message = "请先选择商品";
            return $data_push->toJson();
            exit;
        }
        for ($i = 0; $i < count($arr); $i++) {
            Cart::add($arr[$i][0], $arr[$i][1], $arr[$i][2], 1, array('preview' => $arr[$i][3]));
        }
        $data_push->status = 0;
        $data_push->message = "添加成功";
        return $data_push->toJson();
    }

    public function getDelete(Request $request)
    {
        $arr = $request->input('data', '');
        $data_push = new dataPusher();
        if ($arr == "") {
            $data_push->status = 1;
            $data_push->message = "请先选择商品";
            return $data_push->toJson();
            exit;
        }
        for ($i = 0; $i < count($arr); $i++) {
            Cart::remove($arr[$i][0]);
        }
        $data_push->status = 0;
        $data_push->message = "删除成功";
        return $data_push->toJson();
    }

}