@extends("master")
@section("title","历史订单")
@section("content")
    <div class="page-header"><h1>历史订单</h1></div>
    <table class="table table-striped text-center">
        <th>
            <td>订单号</td>
            <td>预约人姓名</td>
            <td>预约医院</td>
            <td>预约科室</td>
            <td>预约医生</td>
            <td>预约时间</td>
            <td>状态</td>
        </th>
        @foreach($orders as $order)
            <tr>
                <td></td>
                <td class="order_class" id="{{$order-id}}">{{$order->id}}</td>
                <td>{{$order->user->name}}</td>
                <td><a href="hospital?id={{$order->doctor->office->hospital->id}}">{{$order->doctor->office->hospital->name}}</a></td>
                <td>{{$order->doctor->office->name}}</td>
                <td><a href="doctorInformation?id={{$order->doctor->id}}">{{$order->doctor->name}}</a></td>
                <td>{{$order->appoint_date}}</td>
                <td>{{$order->state}}</td>
            </tr>
        @endforeach
    </table>
@stop