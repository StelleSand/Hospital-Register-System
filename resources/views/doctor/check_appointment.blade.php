@extends("master")
@section("title","预约管理")
@section("script")
    <script>
        $(document).ready(function(){
            var button=$("<button></button>").addClass("btn").addClass("btn-primary").attr("onclick","confirm(this)").text("确认就诊");
            var order_list=$(".order_list");
            for(var i=0;i<order_list.length;i++){
                //if($(order_list[i]).children(".appoint_date").text()==$(order_list[i]).children(".appoint_date").attr("data-date"))
                    if($(order_list[i]).children(".order_status").children("span").text()=="分诊台已核实")
                        $(order_list[i].children(".add_button")).append(button);

            }
        })
        function confirm(btn){
            var id=$(btn).parent().parent().children(".order_id").attr("id");
            var user_name=$(btn).parent().parent().children(".user_name").text();
            var err_message=$('<div></div>').addClass('alert').addClass('alert-warning').addClass('text-center').attr("data-id",id).attr("id","alert_id");
            err_message.html("确认患者"+user_name+"就诊？");
            $('#form-content').empty();
            $('#form-content').append(err_message);
            var button1=$("<button>确定</button>").addClass("btn").addClass("btn-danger").attr("onclick","confirm(this)");
            var button2=$("<button>取消</button>").addClass("btn").addClass("btn-primary").attr("onclick","cancel()");
            $("#addFormModal").find(".modal-footer").empty().append(button1).append(button2);
            $('#addFormModal').modal('show');
        }
        function cancel(){
            $("#addFormModal").modal('hide');
        }
        function confirm(btn){
            var id=$("#alert_id").attr("data-id");
            $("#addFormModal").modal('hide');
            $("#addFormModal").one('hidden.bs.modal',function(e){
                var data = {};
                data['id'] = id;
                ajaxData("doctorConfirm",data,show_result);
            })
        }
        function show_result(data,status){
            if(status!="success"){
                var err_message=$('<div></div>').addClass('alert').addClass('alert-warning').addClass('text-center');
                err_message.html("服务器请求失败");
                showMessage(err_message);
            }
            else{
                var result=JSON.parse(data);
                if(result['status']=='error'){
                    var err_message=$('<div></div>').addClass('alert').addClass('alert-warning').addClass('text-center');
                    err_message.html(result['message']);
                    showMessage(err_message);
                }
                else{
                    var succ_message=$('<div></div>').addClass('alert').addClass('alert-success').addClass('text-center');
                    succ_message.html(result['message']);
                    showMessage(succ_message);
                    var order_list=$(".order_list");
                    for(var i=0;i<order_list.length;i++){
                        if($(order_list[i]).children(".order_id").attr("id")==result['id']){
                            $(order_list[i]).children("order_status").children().text("就诊医生已核实");
                            $(order_list[i]).children(".add_button").empty();
                        }
                    }
                }
            }
        }
    </script>
@stop
@section("content")
    <div class="page-header"><h1>预约管理</h1></div>
    <form class="form-inline" action="workSpace" method="get">
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
                <td class="order_id" id="{{$order->id}}">{{$order->id}}</td>
                <td>{{$order->user->name}}</td>
                <td class="user_name">{{$order->doctor->user->name}}</td>
                <td class="appoint_date" data-date="{{$today}}">{{$order->appoint_date}}</td>
                <td class="order_status">
                    @if ($order->state == 'ordered')
                        <span>已预订未付款</span>
                    @elseif($order->state == 'order_canceled')
                        <span>订单已取消</span>
                    @elseif($order->state == 'payed')
                        <span>已付款可挂号</span>
                    @elseif($order->state == 'payment_canceled')
                        <span>已退款</span>
                    @elseif($order->state == 'triage_checked')
                        <span>分诊台已核实</span>
                    @elseif($order->state == 'doctor_checked')
                        <span>就诊医生已核实</span>
                    @elseif($order->state == 'completed')
                        <span>订单完成</span>
                    @endif
                </td>
                <td class="add_button"></td>
            </tr>
        @endforeach
    </table>
@stop