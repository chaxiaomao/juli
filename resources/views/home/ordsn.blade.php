@extends('home.base')
@section('title', '购物清单')
@section('m-css')
    <style type="text/css">
        div, p, span{color:gray;}
        .weui_btn_primary{margin:20px 0;}
        .weui_cells{margin-top:0px;}
        /*.weui_cells_title{border-bottom: 1px solid #ddd;padding-bottom: .77em;}*/
    </style>
    @endsection
<script src="/js/zepto.min.js"></script>
<script src="/js/picker.js"></script>
<script src="/js/picker-city.js"></script>
<script>
    $(function () {
        $("#ssx").cityPicker({
            title: "选择省市县"
        });
        $("#ss").cityPicker({
            title: "选择省市",
            showDistrict: false
        });
    });
</script>
@section('content')
    {{--<div class="weui_cells_title">购物清单</div>--}}
    <h2>购物清单</h2>
    <form id="mform" method="post" action="/service/order/commit">
        {{ csrf_field() }}
        <input value="{{ $ids }}" name="ids" hidden/>
        <div class="weui_cells weui_cells_form">
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">收货人</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input id="receiver" name="receiver" class="weui_input" type="text" placeholder="收货人"/>
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">手机号</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input id="tel" name="tel" class="weui_input" type="number" placeholder="手机号"/>
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label for="" class="weui_label">省市县:</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input name="city" class="weui_input" type="text" value="" id='ssx'/>
                </div>
            </div>
            {{--<div class="weui_cell">--}}
                {{--<div class="weui_cell_hd"><label for="" class="weui_label">省市:</label></div>--}}
                {{--<div class="weui_cell_bd weui_cell_primary">--}}
                    {{--<input name="" class="weui_input" type="text" value="" id='ss'/>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">收货地址</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input id="location" name="location" class="weui_input" type="text" placeholder="收货地址"/>
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
                                        style="background-image:url({{ $item['attributes']['preview'] }});background-color: #0bb20c"></li>
                                    <span>商品名称：{{ $item['name'] }}</span><br>
                                    <span>价   格：{{ $item['price'] }}元</span><br>
                                    <span>数   量：{{ $item['quantity'] }}</span>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div style="width: 80%;margin:0 auto;">
            <button id="submit" type="submit" class="weui_btn weui_btn_primary">一共{{ $total }}元 立即支付</button>
            {{--<button id="checkout" type="button" class="weui_btn weui_btn_primary">一共{{ $total }}元 立即支付</button>--}}
        </div>
    </form>
@endsection

@section('m-js')
    <script type="text/javascript">
//        var btn = document.getElementById("checkout");
//        btn.onclick = function () {
//            checkoutForm();
//            btn.style.display = 'none';
//            document.getElementById("submit").style.display = 'block';
//        }
//        function toasting(msg) {
//            $(".juli_toptips").show();
//            $(".juli_toptips span").html(msg);
//            setTimeout(function () {
//                $(".juli_toptips").hide();
//            }, 2000);
//            btn.disabled = true;
//            return false;
//        }
//        function checkoutForm() {
//            var receiver = document.getElementById("receiver").value;
//            var tel = document.getElementById("tel").value;
//            var city = document.getElementById("city").value;
//            var location = document.getElementById("location").value;
//            if (receiver == '') {
//                toasting("请填写收货人姓名");
//            }
//            if (tel == '') {
//                toasting("请填写收货人手机");
//            }
//            if (city == '') {
//                toasting("请选择城市");
//            }
//            if (location == '') {
//                toasting("请填写收货地址");
//            }
//        }
    </script>
    @endsection