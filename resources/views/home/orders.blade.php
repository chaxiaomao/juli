@extends('home.base')
@section('title', '我的订单')
@section('m-css')
    <style type="text/css">
        body{color:gray;}
        .weui-form-preview{margin-bottom: 20px;}
    </style>
@endsection
@section('content')
    <h2>所有订单</h2>
    @foreach($orders as $order)
        <div class="weui-form-preview">
            <div class="weui-form-preview-hd">
                <label class="weui-form-preview-label">付款金额</label>
                <em class="weui-form-preview-value">{{ $order->total }}</em>
            </div>
            <div class="weui-form-preview-bd">
                <p>
                    <label class="weui-form-preview-label">订单号</label>
                    <span class="weui-form-preview-value">{{ $order->ordsn }}</span>
                </p>
                <p>
                    <label class="weui-form-preview-label">创建时间</label>
                    <span class="weui-form-preview-value">{{ $order->created_at }}</span>
                </p>
                <p>
                    <label class="weui-form-preview-label">支付时间</label>
                    <span class="weui-form-preview-value">{{ $order->paid_at ==null? "未支付" : $order->paid_at }}</span>
                </p>
            </div>
            <div class="weui-form-preview-ft">
                <a class="weui-form-preview-btn weui-form-preview-btn-primary" href="/home/order/{{ $order->id }}">查看详情</a>
            </div>
        </div>
    @endforeach
@endsection