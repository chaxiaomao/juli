@extends('admin.base')
<div class="page-container">
    <form action="/at/admin/order/edit" method="post" class="form form-horizontal" id="form-product-edit">
        {{ csrf_field() }}
        <input name="id" value="{{ $order->id }}" hidden/>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>订单编号：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{ $order->ordsn }}" name="ordsn" readonly>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>收货人：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{ $order->receiver }}" name="receiver" readonly>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>城市：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="city" value="{{ $order->city }}" class="input-text" readonly>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>收货地址：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="location" value="{{ $order->location }}" class="input-text" readonly>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>订单金额：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="number" name="total" value="{{ $order->total }}" class="input-text" readonly>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>支付状态：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if ($order->paid == 1)
                    <input type="text" name="paid" value="未支付" class="input-text" readonly>
                @else
                    <input type="text" name="paid" value="已支付" class="input-text" readonly>
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>发货状态：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if ($order->send == 1)
                    <input type="text" name="send" value="未发货" class="input-text" readonly>
                @else
                    <input type="text" name="send" value="已发货" class="input-text" readonly>
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>签收状态：</label>
            <div class="formControls col-xs-8 col-sm-9">
				@if ($order->sign == 1)
                    <input type="text" name="sign" value="未签收" class="input-text" readonly>
                @else
                    <input type="text" name="sign" value="已签收" class="input-text" readonly>
                @endif
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>创建时间：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="count" id="" placeholder="" value="{{ $order->created_at }}" class="input-text">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>支付时间：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="count" id="" placeholder="" value="{{ $order->paid_at }}" class="input-text">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>交易快照：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <table class="table table-border table-bordered">
                    <thead class="text-c">
                    <tr>
                        <th>商品名字</th>
                        <th>价格</th>
                        <th>数量</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }} 元</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>快递订单：</label>
            <div class="formControls col-xs-8 col-sm-9">
                @if($order->delivery)
                    <input type="text" name="waybill" placeholder="" value="{{ $order->delivery->waybill }}" class="input-text">
                @else
                    <input type="text" name="waybill" placeholder="填写运单号" value="" class="input-text">
                @endif
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 确认发货</button>
                {{--<button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>--}}
                <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>