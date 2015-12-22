@extends("master")
@section("title","历史订单")
@section("script")
@stop
@section("content")
    <div class="page-header"><h1>分诊台管理</h1></div>
        <form class="form-inline" action="workSpace" method="get">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control">选择日期</label>
                        <input type="date" class="form-control check_list" name="date">
                    </div>
                </div>
                <!--这里也可以使用select-->
                <div class="col-md-2">
                    <div class="form-group">
                        <label>选择科室</label>
                        <input type="text" class="form-control check_list" name="office">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>选择医生</label>
                        <input type="text" class="form-control check_list" name="doctor">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>订单号</label>
                        <input type="text" class="form-control check_list" name="order_id">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>预约人姓名</label>
                        <input type="text" class="form-control check_list" name="user_name">
                    </div>
                </div>
            </div>
            <div class="row text-right">
                <button class="btn btn-primary" type="submit">查询</button>
            </div>
        </form>
        <br/>
        <table class="table table-striped text-center">
            <th>
                <td>预约号</td>
                <td>预约人姓名</td>
                <td>预约科室</td>
                <td>预约医生</td>
                <td>预约时间</td>
                <td>状态</td>
                <td>操作</td>
            </th>
            @foreach($orders as $order)
                <tr>
                    <td></td>
                    <td>{{$order->id}}</td>
                    <td>{{$order->user->name}}</td>
                    <td>{{$order->doctor->office->name}}</td>
                    <td>{{$order->doctor->user->name}}</td>
                    <td>{{$order->appoint_date}}</td>
                    <td>
                        @if ($order->state == 'ordered')
                            已预订未付款
                        @elseif($order->state == 'order_canceled')
                            订单已取消
                        @elseif($order->state == 'payed')
                            已付款可挂号
                        @elseif($order->state == 'payment_canceled')
                            已退款
                        @elseif($order->state == 'triage_checked')
                            分诊台已核实
                        @elseif($order->state == 'doctor_checked')
                            就诊医生已核实
                        @elseif($order->state == 'completed')
                            订单完成
                        @endif
                    </td>
                    <td><button class="btn btn-primary">打印预约单</button></td>
                </tr>
            @endforeach
        </table>
@stop