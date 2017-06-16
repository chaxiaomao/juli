@extends('home.base')
@section('m-css')
    <style type="text/css">
        body{color:gray;}
        .weui-form-preview-bd{padding:0px; margin:10px 15px;border-bottom: 1px dashed #ddd;}
    </style>
@endsection
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
            <button class="weui-form-preview-btn weui-form-preview-btn-primary" onclick="wechatPayment()">立即支付</button>
        </div>
    </div>
@endsection

@section('m-js')
    <script type="text/javascript">
        var wechatPayment = function () {
            if (typeof WeixinJSBridge === 'undefined') {
                alert('请在微信在打开页面！');
                return false;
            }
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest', {!! $payconfig !!}, function (res) {
                    switch (res.err_msg) {
                        case 'get_brand_wcpay_request:cancel':
                            alert('用户取消支付！');
                            break;
                        case 'get_brand_wcpay_request:fail':
                            alert('支付失败！（' + res.err_desc + '）');
                            break;
                        case 'get_brand_wcpay_request:ok':
                            alert('支付成功！');
                            location.href = "/home/personal";
                            break;
                        default:
                            alert(JSON.stringify(res));
                            break;
                    }
                });
        }
    </script>
@endsection