@extends('home.base')

@section('m-css')
    <style type="text/css">
        img{width:90px;height: 90px;background-color: #0bb20c}
        .weui_cells_checkbox .weui_check:checked+.weui_icon_checked:before{color:rgb(0, 160, 233)}
    </style>
    @endsection

@section('content')
    <div class="weui_cells_title">购物车</div>
    <div class="weui_cells weui_cells_checkbox">
        <label class="weui_cell weui_check_label" for="s11">
            <div class="weui_cell_hd">
                <input type="checkbox" class="weui_check" name="checkbox1" id="s11" checked="checked">
                <i class="weui_icon_checked"></i>
            </div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>美国</p>
            </div>
        </label>
        <label class="weui_cell weui_check_label" for="s12">
            <div class="weui_cell_hd">
                <input type="checkbox" name="checkbox1" class="weui_check" id="s12">
                <i class="weui_icon_checked"></i>
            </div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>英国</p>
            </div>
        </label>
        <label class="weui_cell weui_check_label" for="s13">
            <div class="weui_cell_hd">
                <input type="checkbox" name="checkbox1" class="weui_check" id="s13">
                <i class="weui_icon_checked"></i>
            </div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>法国</p>
            </div>
        </label>
        <label class="weui_cell weui_check_label" for="s14">
            <div class="weui_cell_hd">
                <input type="checkbox" name="checkbox1" class="weui_check" id="s14">
                <i class="weui_icon_checked"></i>
            </div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>德国</p>
                <img src="" />
            </div>
        </label>
    </div>
    <div id="fix-btn">
        <a href="/home/">删除商品</a>|
        <a href="/home/ordsn">立即购买</a>
    </div>
    @endsection