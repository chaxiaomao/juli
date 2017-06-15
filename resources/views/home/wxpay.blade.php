@extends('home.base')

@section('content')
    <h2>微信支付</h2>
    <div class="weui-form-preview">
        <div class="weui-form-preview-hd">
            <label class="weui-form-preview-label">付款金额</label>
            <em class="weui-form-preview-value">¥{{ $total }}</em>
        </div>
        @foreach($items as $item)
            <div class="weui-form-preview-bd">
                <p>
                    <label class="weui-form-preview-label">商品名字</label>
                    <span class="weui-form-preview-value">{{ $item->name }}</span>
                </p>
                <p>
                    <label class="weui-form-preview-label">价格</label>
                    <span class="weui-form-preview-value">{{ $item->price }}</span>
                </p>
                <p>
                    <label class="weui-form-preview-label">数量</label>
                    <span class="weui-form-preview-value">{{ $item->quantity }}</span>
                </p>
            </div>
        @endforeach
        <div class="weui-form-preview-ft">
            <a class="weui-form-preview-btn weui-form-preview-btn-default" href="javascript:history.go(-1)">返回上一页</a>
            <button class="weui-form-preview-btn weui-form-preview-btn-primary" href="javascript:">立即支付</button>
        </div>
    </div>
@endsection