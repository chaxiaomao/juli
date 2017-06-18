@extends('admin.base')
@section('m-link')
    <link rel="stylesheet" href="/admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
@endsection
<div class="pos-a" style="width:200px;left:0;top:0; bottom:0; height:100%; border-right:1px solid #e5e5e5; background-color:#f5f5f5; overflow:auto;">
    <ul id="treeDemo" class="ztree"></ul>
</div>
<div style="margin-left:200px;">
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="text-c"> 日期范围：
            <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
            <input type="text" name="" id="" placeholder=" 产品名称" style="width:250px" class="input-text">
            <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜产品</button>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="category_add('添加种类','/at/admin/category/add')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加种类</a></span> <span class="r">共有数据：<strong>{{ count($categorys) }}</strong> 条</span> </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-hover table-sort">
                <thead>
                <tr class="text-c">
                    <th width="40"><input name="" type="checkbox" value=""></th>
                    <th width="40">ID</th>
                    <th width="">名称</th>
                    <th width="100">产品种类ID</th>
                    <th width="100">产品父类ID</th>
                    <th width="100">状态</th>
                    <th width="100">操作</th>
                    <th width="150">查看商品</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categorys as $category)
                    <tr class="text-c va-m">
                        <td><input name="" type="checkbox" value=""></td>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td><span>{{ $category->category_id }}</span></td>
                        <td><span>{{ $category->parent_id }}</span></td>
                        <td class="td-status">
                            {!! $category->status == 0? '<span class="label label-success radius">已上架</span>' : '<span class="label label-defaunt radius">已下架</span>' !!}
                        </td>
                        <td class="td-manage">
                            @if($category->status == 0)
                                <a style="text-decoration:none" onClick="category_stop(this, '{{ $category->id }}')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
                            @else
                                <a style="text-decoration:none" onClick="category_start(this, '{{ $category->id }}')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>
                            @endif
                            <a style="text-decoration:none" class="ml-5" onClick="category_edit('产品种类编辑','/at/admin/category/edit?id=' + '{{ $category->id }}')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
                            {{--<a style="text-decoration:none" class="ml-5" onClick="product_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>--}}
                        </td>
                        <td><a href="javascript:;" class="btn btn-secondary-outline radius" onclick="product_list('{{ $category->name }}', '/at/admin/product/list?category_id=' + '{{ $category->category_id }}')">查看商品</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('m-js')
        <!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    var setting = {
        view: {
            dblClickExpand: false,
            showLine: false,
            selectedMulti: false
        },
        data: {
            simpleData: {
                enable:true,
                idKey: "id",
                pIdKey: "pId",
                rootPId: ""
            }
        },
        callback: {
            beforeClick: function(treeId, treeNode) {
                var zTree = $.fn.zTree.getZTreeObj("tree");
                if (treeNode.isParent) {
                    zTree.expandNode(treeNode);
                    return false;
                } else {
                    //demoIframe.attr("src",treeNode.file + ".html");
                    return true;
                }
            }
        }
    };

    var zNodes =[
        { id:1, pId:0, name:"分类1", open:false},
        { id:11, pId:1, name:"1"},
        { id:12, pId:1, name:"2"},
        { id:13, pId:1, name:"3"},
        { id:14, pId:1, name:"4"},
        { id:15, pId:1, name:"5"},
        { id:16, pId:1, name:"6"},
        { id:17, pId:1, name:"6"},
        { id:18, pId:1, name:"7"},
        { id:2, pId:0, name:"分类2", open:false},
        { id:21, pId:2, name:"1"},
        { id:22, pId:2, name:"2"},
    ];



    $(document).ready(function(){
        var t = $("#treeDemo");
        t = $.fn.zTree.init(t, setting, zNodes);
        //demoIframe = $("#testIframe");
        //demoIframe.on("load", loadReady);
        var zTree = $.fn.zTree.getZTreeObj("tree");
        //zTree.selectNode(zTree.getNodeByParam("id",'11'));
    });

    $('.table-sort').dataTable({
        "aaSorting": [[ 1, "desc" ]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
            {"orderable":false,"aTargets":[0,7]}// 制定列不参与排序
        ]
    });
    /*分类-添加*/
    function category_add(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*分类产品-查看*/
    function product_list(title,url,id){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*产品-审核*/
    function product_shenhe(obj,id){
        layer.confirm('审核文章？', {
                    btn: ['通过','不通过'],
                    shade: false
                },
                function(){
                    $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                    $(obj).remove();
                    layer.msg('已发布', {icon:6,time:1000});
                },
                function(){
                    $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="product_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
                    $(obj).remove();
                    layer.msg('未通过', {icon:5,time:1000});
                });
    }
    /*分类-下架*/
    function category_stop(obj,id){
        layer.confirm('确认要下架吗？',function(index){
            $.ajax({
                url: "/service/category/stop",
                type: "get",
                data: {id: id},
                dataType: "json",
                success: function(data) {
                    if (data.status == null) {
                        layer.msg('服务器错误!',{icon: 5,time:1000});
                        return false;
                    }
                    if (data.status == 1) {
                        layer.msg(data.message, {icon: 5,time:1000});
                        return false;
                    }
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="category_start(this,' + id +')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
                    $(obj).remove();
                    layer.msg(data.message, {icon: 5,time:1000});
                },
                error: function() {

                }
            });
        });
    }

    /*分类-发布*/
    function category_start(obj,id){
        layer.confirm('确认要发布吗？',function(index){
            $.ajax({
                url: "/service/category/start",
                type: "get",
                data: {id: id},
                dataType: "json",
                success: function(data) {
                    if (data.status == null) {
                        layer.msg('服务器错误!',{icon: 5,time:1000});
                        return false;
                    }
                    if (data.status == 1) {
                        layer.msg(data.message, {icon: 5,time:1000});
                        return false;
                    }
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="category_stop(this,' + id +')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已上架</span>');
                    $(obj).remove();
                    layer.msg(data.message, {icon: 6,time:1000});
                },
                error: function() {

                }
            });
        });
    }

    /*产品-申请上线*/
    function product_shenqing(obj,id){
        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
        $(obj).parents("tr").find(".td-manage").html("");
        layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
    }

    /*产品-编辑*/
    function category_edit(title,url,id){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*产品-删除*/
    function product_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                success: function(data){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }
</script>
@endsection