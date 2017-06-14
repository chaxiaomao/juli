@extends('home.base')

@section('content')
    <h2>微信支付</h2>
    <div class="weui-form-preview">
        <div class="weui-form-preview-hd">
            <label class="weui-form-preview-label">付款金额</label>
            <em class="weui-form-preview-value">¥2400.00</em>
        </div>
        <div class="weui-form-preview-bd">
            <p>
                <label class="weui-form-preview-label">商品</label>
                <span class="weui-form-preview-value">电动打蛋机</span>
            </p>
            <p>
                <label class="weui-form-preview-label">标题标题</label>
                <span class="weui-form-preview-value">名字名字名字</span>
            </p>
            <p>
                <label class="weui-form-preview-label">标题标题</label>
                <span class="weui-form-preview-value">很长很长的名字很长很长的名字很长很长的名字很长很长的名字很长很长的名字</span>
            </p>
        </div>
        <div class="weui-form-preview-ft">
            <a class="weui-form-preview-btn weui-form-preview-btn-default" href="javascript:history.go(-1)">返回上一页</a>
            <button class="weui-form-preview-btn weui-form-preview-btn-primary" href="javascript:">立即支付</button>
        </div>
    </div>
    @endsection