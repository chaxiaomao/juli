<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
//use App\Entity\Member;

class wechatCallbackController extends Controller
{
    public function oauthCallback()
    {
        $config = [
            'debug'     => true,
            'app_id'    => env('WECHAT_APPID'),
            'secret'    => env('WECHAT_SECRET'),
            'token'     => env('WECHAT_TOKEN'),
        ];
        $app = new Application($config);
        $oauth = $app->oauth;
        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        session()->put('user.wechat', $user->toArray());
        return back();
    }

    public function payCallback()
    {
        $return_data = file_get_contents("php://input");
        libxml_disable_entity_loader(true);
        $data = simplexml_load_string($return_data, 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($data->return_code == 'SUCCESS') {
            $order = Order::where('ordsn', $data->out_trade_no)->first();
            $order->paid = 0;
            $order->paid_at = date("Y-m-d H:i:s", time() + 8 * 60 * 60);
            $order->save();
            return "<xml>
                <return_code><![CDATA[SUCCESS]]></return_code>
                <return_msg><![CDATA[OK]]></return_msg>
              </xml>";
        }
        return "<xml>
              <return_code><![CDATA[FAIL]]></return_code>
              <return_msg><![CDATA[FAIL]]></return_msg>
            </xml>";
    }

}