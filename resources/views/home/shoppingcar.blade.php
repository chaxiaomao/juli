@extends('home.base')

@section('m-css')
    <style type="text/css">
        img{width:90px;height: 90px;background-color: #0bb20c}
        .weui_cells_checkbox .weui_check:checked+.weui_icon_checked:before{color:rgb(0, 160, 233)}
    </style>
    @endsection

@section('content')
    <div class="weui_cells_title">购物车</div>
    <form action="/home/">

    </form>
    <div class="weui_cells weui_cells_checkbox">
        @foreach($cart_items as $cart_item)
            <label class="weui_cell weui_check_label" for="{{ $cart_item['id'] }}">
                <div class="weui_cell_hd">
                    <input type="checkbox" name="product" value="{{ $cart_item['id'] }}" class="weui_check" id="{{ $cart_item['id'] }}">
                    <i class="weui_icon_checked"></i>
                </div>
                <div class="weui_cell_bd weui_cell_primary">
                    <p>商品名称：{{ $cart_item['name'] }}</p>
                    <p>商品价格：{{ $cart_item['price'] }}</p>
                    <p>商品数量：{{ $cart_item['quantity'] }}</p>
                    <img src="{{ $cart_item['attributes']['preview'] }}" />
                </div>
            </label>
            @endforeach
    </div>
    <div id="fix-btn">
        <a href="javascript:;" onclick="">删除商品</a>|
        <a href="/home/ordsn">立即购买</a>
    </div>
    @endsection