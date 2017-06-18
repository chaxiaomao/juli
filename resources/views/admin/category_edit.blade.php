@extends('admin.base')
{{--<link href="/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />--}}
<div class="page-container">
    <form action="/at/admin/category/edit" method="post" class="form form-horizontal" id="form-category-edit">
        {{ csrf_field() }}
        <input name="id" value="{{ $category->id }}" hidden>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>类别名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{ $category->name }}" placeholder="" name="name">
            </div>
        </div>
        {{--<div class="row cl">--}}
        {{--<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属父类：</label>--}}
        {{--<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">--}}
        {{--<select name="category_no" class="select">--}}
        {{--<option value="1">顶级类别</option>--}}
        {{--<option value="11">├一代商品</option>--}}
        {{--<option value="11">├二代商品</option>--}}
        {{--<option value="13">├三代商品</option>--}}
        {{--</select>--}}
        {{--</span> </div>--}}
        {{--</div>--}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>类别ID：</label>

            <div class="formControls col-xs-8 col-sm-9">
                <input type="number" class="input-text" value="{{ $category->category_id }}" placeholder=""
                       name="category_id" readonly>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交</button>
                <button onClick="layer_close();" class="btn btn-default radius" type="button">
                    &nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>
{{--@section('m-js')--}}
    {{--<script type="text/javascript">--}}
        {{--$(function () {--}}
            {{--$('.skin-minimal input').iCheck({--}}
                {{--checkboxClass: 'icheckbox-blue',--}}
                {{--radioClass: 'iradio-blue',--}}
                {{--increaseArea: '20%'--}}
            {{--});--}}

            {{--$("#form-category-edit").validate({--}}
                {{--rules: {--}}
                    {{--name: {--}}
                        {{--required: true,--}}
                        {{--minlength: 2,--}}
                        {{--maxlength: 16--}}
                    {{--},--}}
                {{--},--}}
                {{--onkeyup: false,--}}
                {{--focusCleanup: true,--}}
                {{--success: "valid",--}}
                {{--submitHandler: function (form) {--}}
                    {{--//$(form).ajaxSubmit();--}}
                    {{--var index = parent.layer.getFrameIndex(window.name);--}}
                    {{--//parent.$('.btn-refresh').click();--}}
                    {{--parent.layer.close(index);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
{{--@endsection--}}