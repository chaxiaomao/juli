@extends('home.base')

@section('m-css')

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
        </div>

@endsection