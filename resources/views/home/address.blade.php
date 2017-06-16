@extends('home.base')
@section('title', '收货地址')
@section('m-css')
    <style type="text/css">
        body{color:gray;}
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
    <h2>填写地址</h2>
    <form id="mform" method="post" action="/service/address/commit">
        {{ csrf_field() }}
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
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">收货地址</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input id="location" name="location" class="weui_input" type="text" placeholder="收货地址"/>
                </div>
            </div>
        </div>
        <div style="width: 80%;margin:0 auto;">
            <button id="submit" type="submit" class="weui_btn weui_btn_primary">保存地址</button>
        </div>
    </form>
@endsection