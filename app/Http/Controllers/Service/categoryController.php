<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Tool\dataPusher;

class categoryController extends Controller
{
    public function getStop()
    {
        $data_pusher = new dataPusher();
        if (count(Category::where('status', 0)->get()) == 1) {
            $data_pusher->status = 1;
            $data_pusher->message = "至少保留一个产品种类";
            return $data_pusher->toJson();
            exit;
        }
        $category = Category::find($_GET['id']);
        $category->status = 1;
        $category->save();
        $data_pusher->status = 0;
        $data_pusher->message = "已下架";
        return $data_pusher->toJson();
    }

    public function getStart()
    {
        $data_pusher = new dataPusher();
        $category = Category::find($_GET['id']);
        $category->status = 0;
        $category->save();
        $data_pusher->status = 0;
        $data_pusher->message = "已上架";
        return $data_pusher->toJson();
    }

}