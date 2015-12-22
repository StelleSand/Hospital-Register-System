@extends("master")
@section("title","历史订单")
@section("script")
    <script>
        $(function(){
            $('.form_date').datetimepicker({
            language:  'zh-CN',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        })
    </script>
@stop
@section("content")
    <div class="page-header"><h1>分诊台管理</h1></div>
        <form class="form-inline">
            <div class="form-group">
                <label for="input2" class="control-label">选择日期</label>
                <div class="input-group date form_date" data-date data-date-format="yyyy年mm月dd日" data-link-field="dtp_input2" data-link-format="yyyy-m-d">
                    <input class="form-control" id="input1"  type="text" name="date_to_show" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <input type="hidden" id="input2" name="date">
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