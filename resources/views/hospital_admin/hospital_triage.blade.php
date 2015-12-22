@extends("master")
@section("title","历史订单")
@section("script")
@stop
@section("content")
    <div class="page-header"><h1>分诊台管理</h1></div>
        <form class="form-inline">
            <div class="form-group">
                <label>选择日期</label>
                <input type="date" class="form-control check_list" name="date">
            </div>
            <!--这里也可以使用select-->
            <div class="form-group">
                <label>选择科室</label>
                <input type="text" class="form-control check_list" name="office">
            </div>
            <div class="form-group">
                <label>选择医生</label>
                <input type="text" class="form-control check_list" name="doctor">
            </div>
            <div class="form-group">
                <label>订单号</label>
                <input type="text" class="form-control check_list" name="order_id">
            </div>
            <div class="form-group">
                <label>预约人姓名</label>
                <input type="text" class="form-control check_list" name="user_name">
            </div>
            <button class="btn btn-primary" type="submit">查询</button>
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
                    <td>{{$order->doctor->name}}</td>
                    <td>{{$order->appoint_time}}</td>
                    <td>{{$order->status}}</td>
                    <td><button class="btn btn-primary">打印预约单</button></td>
                </tr>
            @endforeach
        </table>
@stop