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
            <td>下单时间</td>
            <td>预约时间</td>
            <td>状态</td>
        </th>
        @foreach($orders as $order)
            <tr>
                <td></td>
                <td class="order_class" id="{{$order->id}}">{{$order->id}}</td>
                <td>{{$order->user->name}}</td>
                <td><a href="hospital?id={{$order->doctor->office->hospital->id}}">{{$order->doctor->office->hospital->name}}</a></td>
                <td>{{$order->doctor->office->name}}</td>
                <td><a href="doctorInformation?id={{$order->doctor->id}}">{{$order->doctor->user->name}}</a></td>
                <td>{{$order->order_date}}</td>
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
            </tr>
        @endforeach
    </table>
@stop