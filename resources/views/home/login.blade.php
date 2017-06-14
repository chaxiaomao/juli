@extends('home.base')

@section('title', "登录")
<link rel="stylesheet" href="/fonts/Elephant.ttf">
@section('content')
    <form id="form" action="/user/login" method="post">
        {{ csrf_field() }}
        <div class="weui_cells_title">手机 - 登陆</div>
        <div class="weui_cells weui_cells_form">
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">手机号</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input name="phone" class="weui_input" type="tel" required pattern="[0-9]{11}" maxlength="11" placeholder="输入你的手机号" emptyTips="请输入手机号" notMatchTips="请输入正确的手机号">
                </div>
                <div class="weui_cell_ft">
                    <i class="weui_icon_warn"></i>
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input name="password" class="weui_input" type="password" maxlength="11" placeholder="输入你的密码" emptyTips="请输入手机号" notMatchTips="请输入正确的手机号">
                </div>
                <div class="weui_cell_ft">
                    <i class="weui_icon_warn"></i>
                </div>
            </div>
            <div class="weui_cell weui_vcode">
                <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input name="validate_code" class="weui_input" type="text" required placeholder="点击验证码更换" tips="请输入验证码">
                </div>
                <div class="weui_cell_ft">
                    <img src="/service/validate_code/create" class="jl_validate_code" onclick="change_valide_code(this)"/>
                </div>
            </div>
        </div>
        <div class="weui_btn_area weui_btn_area_inline">
            <button type="submit" class="weui_btn weui_btn_primary">登陆</button>
            {{--<a href="javascript:;" class="weui_btn weui_btn_primary">按钮</a>--}}
            <a href="/user/register" style="line-height: 42px;">没有账号?马上注册</a>
        </div>
    </form>
@endsection

@section('m-js')
    <script type="text/javascript">
        function change_valide_code(obj) {
            $(obj).attr('src', '/service/validate_code/create?random=' + Math.random());
        }

        function post_register() {
            $(".juli_toptips").show();
            $(".juli_toptips span").html("发送成功");
            setTimeout(function() {$(".juli_toptips").show();}, 2000);
            var validate_code = $("input[name=validate_code]").val();
            $.ajax({
                url: "/service/post_register",
                data: {validate_code: validate_code, _token : "{{ csrf_token() }}"},
                type: "post",
                dateType: "JSON",
                beforeSend: function () {

                },
                success: function (data) {
                    $(".juli_toptips span").html(data);
                    setTimeout(function() {$(".juli_toptips").hide();}, 2000);
                },
                error: function () {

                },
                complete: function () {

                }
            })
        }
    </script>
@endsection