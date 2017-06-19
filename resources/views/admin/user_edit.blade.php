@extends('admin.base')
<div class="page-container">
    <form action="/at/admin/user/edit" method="post" class="form form-horizontal" id="form-product-edit">
        {{ csrf_field() }}
        <input name="id" value="{{ $user->id }}" hidden/>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>昵称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{ $user->username }}" name="username" readonly>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>头像：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <img id="avatar" src="{{ $user->avatar }}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id').click()" />
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>手机号码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="phone" value="{{ $user->phone }}" class="input-text" readonly>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>上次登录IP：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="ip" value="{{ $user->ip }}" class="input-text" readonly>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>代理商ID：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="number" name="agent_id" value="{{ $user->agent_id }}" class="input-text" readonly>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>注册时间：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="created_at" value="{{ $user->created_at }}" class="input-text" readonly>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                {{--<button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 确认发货</button>--}}
                <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>