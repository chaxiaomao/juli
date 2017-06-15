<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
//use App\Entity\Member;

class oauthController extends Controller
{
    public function callback()
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

}