@extends('home.base')

@section('m-css')
    <style type="text/css">
        div, p, span{color:gray;}
        .weui_btn_primary{margin:20px 0;}
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
    <div class="weui_cells_title">购物清单</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">收货人</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" placeholder="收货人"/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">手机号</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" pattern="[0-11]*" placeholder="手机号"/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label for="" class="weui_label">省市县:</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" value="" id='ssx'/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label for="" class="weui_label">省市:</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" value="" id='ss'/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">收货地址</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" placeholder="收货地址"/>
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
                                <span>价格：{{ $item['price'] }}元</span><br>
                                <span>数量：{{ $item['quantity'] }}</span>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div style="width: 80%;margin:0 auto;">
        <button type="submit" class="weui_btn weui_btn_primary">一共{{ $total }}元 立即支付</button>
    </div>

@endsection