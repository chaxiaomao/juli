@extends('home.base')

@section('title', '代理中心')

@section('m-css')
    <style>
        #container{position: absolute;height: 100%;width:100%;}
        #left{background-color: #D5D5D5;height:100%;}
        #left li{padding:15px;}
        .active{background-color: gray;color:#fff;}
        #right{background-color: #FFFFFF;height: 100%;position: absolute;right:0px;top:0px;}
        #right li{border-bottom:1px solid #eee;padding:10px;position: relative}
        #right li img:first-child{width:100px;height: 70px;background-color: #0bb20c}
        #right li>span{position: absolute;padding-left: 5px;}
        .pdt_price{bottom:30px;left:115px;color:red;}
        .inp, #right li input{position: absolute;right: 10px;top:40px;width:30px;height: 30px;}
        .inp{z-index: 99;}
    </style>
    @endsection

@section('content')
    {{--"{{ session()->get('user') }}"--}}
    <div id="container">
        <div id="left">
            <ul>
                <li id="li_1">产品系列</li>
                <li id="li_2" class="active">产品系列</li>
                <li id="li_3">产品系列</li>
                <li id="li_4">产品系列</li>
                <li id="li_5">产品系列</li>
                <li id="li_6">产品系列</li>
            </ul>
        </div>
        <div id="right">
            <ul>
                <li>
                    <img src="" />
                    <span>CBT125大</span><br>
                    <span class="pdt_price">58元</span>
                    <img class="inp" src="/images/choose.png" onclick="chooseItem(this, 1)"/>
                    <input id="1" name="product" value="" type="checkbox" />
                </li>
                <li>
                    <img src="" />
                    <span>CBT125大</span><br>
                    <span class="pdt_price">58元</span>
                    <img class="inp" src="/images/choose.png" onclick="chooseItem(this, 2)"/>
                    <input id="2" name="product" value="" type="checkbox" />
                </li>
                <li>
                    <img src="" />
                    <span>CBT125大</span><br>
                    <span class="pdt_price">58元</span>
                    <img class="inp" src="/images/choose.png" onclick="chooseItem(this, 2)"/>
                    <input id="2" name="product" value="" type="checkbox" />
                </li>
            </ul>
        </div>
    </div>
    <div id="fix-btn">
        <a href="/home/shoppingcar">加入购物车</a>|
        <a href="/home/ordsn">立即购买</a>
    </div>
    @endsection

@section('m-js')
    <script src="/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript">
        //分配宽度
        $(function () {
            var l = window.innerWidth / 3.5;//左边宽度数值
            var w = window.innerWidth / 3.5 + "px";//左边宽度像素
            var r = window.innerWidth - l + "px";//右边宽度像素
            $("#left").attr("style", "width:" + w);
            $("#right").attr("style", "width:" + r);
            //li样式
            {{--switch ({!! $active !!}) {--}}
                {{--case 1:--}}
                    {{--$("#li_1").addClass("active");--}}
                    {{--break;--}}
                {{--case 2:--}}
                    {{--$("#li_2").addClass("active");--}}
                    {{--break;--}}
                {{--case 3:--}}
                    {{--$("#li_3").addClass("active");--}}
                    {{--break;--}}
                {{--case 4:--}}
                    {{--$("#li_4").addClass("active");--}}
                    {{--break;--}}
                {{--default:--}}
                    {{--$("#li_0").addClass("active");--}}
            {{--}--}}
            //绑定li
            for (var i = 0; i <= 6; i++) {
                $("#li_" + i).bind("click", {index: i}, clickHandler);
            }
            function clickHandler(event) {
                var i = event.data.index;
                $(".active").removeClass("active");
                $("#li_" + i).addClass("active");
                switch (i) {
                    case 1:

                        break;
                    case 2:

                        break;
                    case 3:

                        break;
                    case 4:
                        break;
                    default:

                }
            }
        });

        function chooseItem(obj, id) {
            if($("#" + id).attr("checked")) {
                $(obj).attr("src", "/images/choose.png");
                $("#" + id).attr("checked", false);
                return;
            }
            $("#" + id).attr("checked", true);
            $(obj).attr("src", "/images/chosen.png");
        }
    </script>
    @endsection