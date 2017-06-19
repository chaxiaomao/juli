@extends('admin.base')
@section('m-link')
    <link href="/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
@endsection
<div class="page-container">
    <form action="/at/admin/product/edit" method="post" class="form form-horizontal" id="form-product-add">
        {{ csrf_field() }}
        <input name="id" value="{{ $product->id }}" hidden>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品名字：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{ $product->name }}" placeholder="" name="name">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品简介：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{ $product->summary }}" placeholder="" name="summary">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属种类：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <span class="select-box">
                    <select name="category_id" class="select">
                        <option value="{{ $product->category_id }}">{{ $product->category->name }}</option>
                        @foreach($categorys as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
				</span>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>价格(单位:元)：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="number" name="price" placeholder="" value="{{ $product->price }}" class="input-text">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">预览图：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div class="uploader-thum-container">
                    @if($product->preview == null)
                        <img id="preview_id" src="/admin/images/icon-add.png" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id').click()" />
                    @else
                        <img id="preview_id" src="{{ $product->preview }}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id').click()" />
                    @endif
                    <input type="file" name="file" id="input_id" style="display: none;" onchange="return uploadImageToServer('path_id','input_id','images', 'preview_id');" />
                    <input id="path_id" style="border:none;width:100%;" name="preview" value="{{ $product->preview }}" hidden />
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">商品详情：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script id="editor" name="content" type="text/plain" style="width:100%; height:400px;"></script>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交</button>
                <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>
@section('m-js')
    <script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
    <script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
    <script type="text/javascript" src="/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" src="/admin/js/uploadFile.js"></script>
    <script type="text/javascript">
        var ue = UE.getEditor('editor');
        ue.execCommand( "getlocaldata" );
        ue.ready(function () {
            ue.setContent('{!! $product->contetn == null? '' : $product->content->content !!}');
        });
    </script>
@endsection