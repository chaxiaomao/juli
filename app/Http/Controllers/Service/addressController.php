<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;

class addressController extends Controller
{
    public function postCommit(Request $request)
    {
        $user = session()->get('user');
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
        $address = Address::where('user_id', $user['user_id'])->first();
        if (!$address) {
            $addres = new Address();
            $addres->receiver = $receiver;
            $addres->tel = $tel;
            $addres->city = $city;
            $addres->location = $location;
            $addres->default = 0;
            $addres->save();
        } else {
            $address->update([
                'receiver' => $receiver,
                'tel' => $tel,
                'city' => $city,
                'location' => $location,
            ]);
        }
        return '<script>alert("保存成功");history.go(-1);</script>';
    }
}