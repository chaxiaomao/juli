@extends('home.base')
@section('title', "购物车")
@section('m-css')
    <style type="text/css">
        img{width:90px;height: 90px;background-color: #0bb20c}
        .weui_cells_checkbox .weui_check:checked+.weui_icon_checked:before{color:rgb(0, 160, 233);}
        .weui_cells{margin-top:0px;}
        #nothing{text-align: center;padding-top: 50%;color:#d5d5d5;font-size: 21px;}
        /*.weui_cells_title{border-bottom: 1px solid #ddd;padding-bottom: .77em;}*/
        p{color:gray}
    </style>
    @endsection
@section('content')
    {{--<div class="weui_cells_title">购物车</div>--}}
    @if(count($items) != 0)
        <h2>购物车商品</h2>
        <div class="weui_cells weui_cells_checkbox">
            @foreach($items as $item)
                <label class="weui_cell weui_check_label" for="{{ $item['id'] }}">
                    <div class="weui_cell_hd">
                        <input type="checkbox" name="product" value="{{ $item['id'] }}" class="weui_check"
                               id="{{ $item['id'] }}">
                        <i class="weui_icon_checked"></i>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>商品名称：{{ $item['name'] }}</p>
                        <p>价格：{{ $item['price'] }}元</p>
                        <p>数量：{{ $item['quantity'] }}</p>
                        <img src="{{ $item['attributes']['preview'] }}"/>
                    </div>
                </label>
            @endforeach
        </div>
    @else
        <p id="nothing">购物车为空<br>请先添加商品到购物车</p>
    @endif
    <div id="fix-btn">
        <a href="javascript:;" onclick="showDialog()">删除商品</a>|
        <a href="javascript:;" onclick="buy()">立即购买</a>
    </div>
    <!--BEGIN dialog1-->
    <div class="js_dialog" id="iosDialog1" style="display: none;">
        <div class="weui-mask"></div>
        <div class="weui-dialog">
            <div class="weui-dialog__hd"><strong class="weui-dialog__title">提示</strong></div>
            <div class="weui-dialog__bd">确定要删除?</div>
            <div class="weui-dialog__ft">
                <div class="weui-dialog__btn weui-dialog__btn_default" onclick="hideDialog()">取消</div>
                <div class="weui-dialog__btn weui-dialog__btn_primary" onclick="productDel(this)">确认</div>
            </div>
        </div>
    </div>
    <!--END dialog1-->
@endsection
<script src="/js/jquery-1.11.2.min.js"></script>
@section('m-js')
    <script type="text/javascript">
        function hideDialog() {
            $("#iosDialog1").css("display", "none");
        }
        function showDialog() {
            if ($("input[name=product]:checked").length == 0) {
                $(".juli_toptips").show();
                $(".juli_toptips span").html("请先选择商品");
                setTimeout(function () {
                    $(".juli_toptips").hide();
                }, 2000);
                return;
            }
            $("#iosDialog1").css("display", "block");
        }
        function productDel() {
            hideDialog();
            var arr = new Array();
            $("input[name=product]:checked").each(function () {
                var id = $(this).val();
                arr.push(new Array(id));
            });
            $.ajax({
                url: "/service/cart/delete",
                data: {data: arr},
                type: "get",
                dataType: "json",
                timeout: 3000,
                success: function (result, status, xhr) {
                    if (result.status == null) {
                        $(".juli_toptips").show();
                        $(".juli_toptips span").html("服务器错误");
                        setTimeout(function () {
                            $(".juli_toptips").hide();
                        }, 2000);
                        return;
                    }
                    if (result.status == 1) {
                        $(".juli_toptips").show();
                        $(".juli_toptips span").html(result.message);
                        setTimeout(function () {
                            $(".juli_toptips").hide();
                        }, 2000);
                        return;
                    }
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }
        function buy() {
            if ($("input[name=product]:checked").length == 0) {
                $(".juli_toptips").show();
                $(".juli_toptips span").html("请先选择商品");
                setTimeout(function () {
                    $(".juli_toptips").hide();
                }, 2000);
                return;
            }
            var arr = new Array();
            $("input[name=product]:checked").each(function () {
                var id = $(this).val();
                arr.push(new Array(id));
            });
            location.href = '/home/ordsn?id=' + arr;
        }
    </script>
@endsection