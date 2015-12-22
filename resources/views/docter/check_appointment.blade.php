@extends("master")
@section("title","预约管理")
@section("script")
    <script>
        $(document).ready(function(){
            var now=new Date();
            var today=1900+now.getYear()+"-"+(now.getMonth()+1)+"-"+now.getDate();
            var now_date=today.split("-");
            var order_list=$(".order_list");
            var appoint=$(order_list[0]).children(".appoint_date");
            var appoint_date=appoint.split("-");
            var button=$("<button></button>").addClass("btn").addClass("btn-primary").attr("onclick","confirm(this)").text("确认就诊");
            if(now_date[0]==appoint_date[0]&&now_date[1]==appoint_date[1]&&now_date[2]==appoint_date[2]){
                for(var i=0;i<order_list.length;i++){
                    if($(order_list[i]).children(".order_status").text()=="待就诊"){    //status需确认
                        $(order_list[i]).children(".add_button").append(button);
                    }
                }
            }

        })
    </script>
@stop
@section("content")
    <div class="page-header"><h1>预约管理</h1></div>
    <form class="form-inline">
        <div class="form-group">
            <label>选择日期</label>
            <input type="date" class="form-control" name="date">
        </div>
        <button class="btn btn-primary" type="submit">确认</button>
    </form>
    <br/>
    <table class="table table-striped text-center">
        <th>
            <td>订单号</td>
            <td>预约人姓名</td>
            <td>预约医生</td>
            <td>预约日期</td>
            <td>预约状态</td>
            <td>操作</td>
        </th>
        @foreach($orders as $order)
            <tr class="order_list">
                <td></td>
                <td id="{{$order->id}}">{{$order->id}}</td>
                <td>{{$order->user->name}}</td>
                <td>{{$order->doctor->name}}</td>
                <td class="appoint_date">{{$order->appoint_date}}</td>
                <td class="order_status">{{$order->status}}</td>
                <td class="add_button"></td>
            </tr>
        @endforeach
    </table>
@stop