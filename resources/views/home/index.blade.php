@extends('home.base')

@section('title', '代理中心')

@section('m-css')
    <style>
        .navbar, #container{position:fixed;}
        .navbar{text-align: right;height: 45px;line-height: 45px;background-color: rgb(0, 160, 233);width: 100%;}
        /*a{display: block}*/
        .icon{font-size: 25px;padding:0 10px;color:#FFFFFF;}
        #container{top:45px;height: 100%;width:100%;}
        #left, #right{overflow-y:scroll;}
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
    {{--"{{ session()->get('user.user_id') }}"--}}
    <div class="navbar">
        <a href="/home/personal"><i class="icon icon-85"></i></a>
    </div>
    <div id="container">
        <div id="left">
            <ul style="margin-bottom: 100px;">
                @foreach($categorys as $category)
                    <li id="li_{{ $category->id }}">{{ $category->name }}</li>
                    {{--<li id="li_2">产品系列</li>--}}
                    {{--<li id="li_3">产品系列</li>--}}
                    {{--<li id="li_4">产品系列</li>--}}
                    {{--<li id="li_5">产品系列</li>--}}
                    {{--<li id="li_6">产品系列</li>--}}
                @endforeach
            </ul>
        </div>
        <div id="right">
            <ul>
                @foreach($products as $product)
                    <li>
                        <img id="preview_{{ $product->id }}" src="{{ $product->preview }}"/>
                        <span id="name_{{ $product->id }}">{{ $product->name }}</span><br>
                        <span id="price_{{ $product->id }}" class="pdt_price">{{ $product->price }}</span>
                        <img class="inp" src="/images/choose.png" onclick="chooseItem(this, '{{ $product->id }}')"/>
                        <input id="{{ $product->id }}" name="product" value="{{ $product->id }}" type="checkbox"/>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div id="fix-btn">
        <a href="javascript:;" onclick="productAdd()">加入购物车</a>|
        <a href="/home/shoppingcar">前往结算</a>
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
            $("#li_{!! $active !!}").addClass("active");
            //绑定li
            for (var i = 0; i <= "{{ count($categorys) }}"; i++) {
                $("#li_" + i).bind("click", {index: i}, clickHandler);
            }
            function clickHandler(event) {
                var i = event.data.index;
                $(".active").removeClass("active");
                $("#li_" + i).addClass("active");
                location.replace('/home/index?cid=' + i);
            }
        });
        function chooseItem(obj, id) {
            if ($("#" + id).attr("checked")) {
                $(obj).attr("src", "/images/choose.png");
                $("#" + id).attr("checked", false);
                return;
            }
            $("#" + id).attr("checked", true);
            $(obj).attr("src", "/images/chosen.png");
        }
        function productAdd() {
            if ($("input[name=product]:checked").length == 0) {
                $(".juli_toptips").show();
                $(".juli_toptips span").html("请先选择商品");
                setTimeout(function () {
                    $(".juli_toptips").hide();
                }, 2000);
                console.log($("input[name=product]:checked").length);
                return;
            }
            var arr = new Array();
            $("input[name=product]:checked").each(function () {
                var id = $(this).val();
                arr.push(new Array(id, $("#name_" + id).html(), $("#price_" + id).html(), $("#preview_" + id)[0].src));
            });
            console.log(arr);
            console.log(arr.length);
            $.ajax({
                url: "/service/cart/add",
                data: {data: arr},
                type: "get",
                dataType: "json",
                cache: false,
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
                    $(".juli_toptips").show();
                    $(".juli_toptips span").html(result.message);
                    setTimeout(function () {
                        $(".juli_toptips").hide();
                    }, 2000);
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }
    </script>
@endsection