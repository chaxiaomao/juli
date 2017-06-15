<?php

namespace App\Http\Middleware;

use Closure;
use EasyWeChat\Foundation\Application;

class wechatOauth
{
    /**
     * 处理传入的请求
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $config = [
            'debug'     => true,
            'app_id'    => env('WECHAT_APPID'),
            'secret'    => env('WECHAT_SECRET'),
            'token'     => env('WECHAT_TOKEN'),
            'oauth' => [
                'scopes'   => ['snsapi_userinfo'],
                //回调地址
                'callback' => '/service/wechat/callback',
            ],
        ];
        //使用配置初始化一个项目实例
        $app = new Application($config);
        //从项目实例中得到一个oauth应用实例
        $oauth = $app->oauth;
        // 未登录
        if (empty(session()->get('user'))) {
            return $oauth->redirect();
            // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
            // $oauth->redirect()->send();
        }
        return $next($request);
    }

}