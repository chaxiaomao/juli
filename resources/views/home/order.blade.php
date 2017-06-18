@extends('home.base')
@section('title', '我的订单')
@section('m-css')
    <style type="text/css">
        body{color:gray;}
        .weui_cells{margin-top: 0px;}
    </style>
@endsection
@section('content')
    <h2>订单详情</h2>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">收货人</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input id="receiver" name="receiver" class="weui_input" type="text" value="{{ $order->receiver }}" readonly>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">手机号</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input id="tel" name="tel" class="weui_input" type="number" value="{{ $order->tel }}" readonly/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label for="" class="weui_label">省市县:</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input name="city" class="weui_input" type="text" value="{{ $order->city }}" readonly/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">收货地址</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input id="location" name="location" class="weui_input" type="text" value="{{ $order->location }}" readonly/>
            </div>
        </div>
        @foreach($items as $item)
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <div class="weui_uploader">
                        <div class="weui_uploader_hd weui_cell">
                            <div class="weui_cell_bd weui_cell_primary">商品快照</div>
                        </div>
                        <div class="weui_uploader_bd">
                            <ul class="weui_uploader_files">
                                <li class="weui_uploader_file"
                                    style="background-image:url({{ $item->attributes->preview }});background-color: #0bb20c"></li>
                                <span>商品名称：{{ $item->name }}</span><br>
                                <span>价   格：{{ $item->price }}元</span><br>
                                <span>数   量：{{ $item->quantity }}</span>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection