@extends('home.base')
@section('title', '个人中心')
@section('m-css')
    <style type="text/css">
        body{background-color: #FFFFFF;color:grey}
        .bg, .bg1, .bg2{text-align: center;}
        .bg{height: 100px;border-bottom:1px solid #EEEEEE;}
        .bg img{width:160px;margin-top:70px;}
        .bg1{padding-bottom: 100px;padding-top:50px;font-size: 18px;line-height: 33px;}
        .bg1 img{width: 100px;border-radius:50%;}
        .bg2{height: auto;border:1px solid #EEEEEE; padding:10px 0;font-size: 15px;display: block}
        .weui_cells{font-size: 15px;margin-bottom: 20px;}
    </style>
@endsection

@section('content')
    <div class="bg">
        <img src="/images/logo.png"/>
    </div>
    <div class="bg1">
        <img src="{{ $user->avatar }}"/>
        <p>代理号：00001</p>
        <p>代理人昵称：{{ $user->username }}</p>
    </div>
    <a class="bg2" href="/at/home">
        <i class="icon icon-27"></i>代理商城
    </a>
    <div class="weui_cells weui_cells_access">
        <a class="weui_cell " href="/at/home/orders">
            <div class="weui_cell_bd weui_cell_primary">
                <p>我的订单</p>
            </div>
            <div class="weui_cell_ft">查看更多订单</div>
        </a>
        <a class="weui_cell " href="/at/home/address">
            <div class="weui_cell_bd weui_cell_primary">
                <p>收货地址</p>
            </div>
            <div class="weui_cell_ft"></div>
        </a>
    </div>
@endsection