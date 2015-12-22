@extends("master")
@section("title","预约管理")
@section("script")
    <script>
        function cancel_appointment(btn){
            var td=$(btn).parent().parent().children();
            var id=$(td[1]).text();
            var err_message=$('<div></div>').addClass('alert').addClass('alert-warning').addClass('text-center').attr("data-id",id).attr("id","alert_id");
            err_message.html("确定要取消该预约？");
            $('#form-content').empty();
            $('#form-content').append(err_message);
            var button1=$("<button>确定</button>").addClass("btn").addClass("btn-danger").attr("onclick","delete_appoint(this)");
            var button2=$("<button>取消</button>").addClass("btn").addClass("btn-primary").attr("onclick","cancel()");
            $("#addFormModal").find(".modal-footer").empty().append(button1).append(button2);
            $('#addFormModal').modal('show');
        }
        function cancel(){
            $("#addFormModal").modal('hide');
        }
        function delete_appoint(btn){
            var id=$("#alert_id").attr("data-id");
            $("#addFormModal").modal('hide');
            $("#addFormModal").one('hidden.bs.modal',function(e){
                //URL需重新写
                var data = {};
                data['id'] = id;
                ajaxData("cancelAppointment",data,show_result);
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
                    var order_id_list=$(".order_class");
                    for(var i=0;i<order_id_list.length;i++){
                        if(result['id']==$(order_id_list[i]).text()){
                            $(order_id_list[i]).parent().remove();
                        }
                    }
                }
            }
        }
    </script>
@stop
@section("content")
    <div class="page-header"><h1>预约管理</h1></div>
    <table class="table table-striped text-center">
        <th>
            <td>订单号</td>
            <td>预约人姓名</td>
            <td>预约医院</td>
            <td>预约科室</td>
            <td>预约医生</td>
            <td>预约时间</td>
            <td>操作</td>
        </th>
        @foreach($orders as $order)
            <tr>
                <td></td>
                <td class="order_class" id="{{$order->id}}">{{$order->id}}</td>
                <td>{{$order->user->name}}</td>
                <td><a href="hospital?id={{$order->doctor->office->hospital->id}}">{{$order->doctor->office->hospital->name}}</a></td>
                <td>{{$order->doctor->office->name}}</td>
                <td><a href="doctorInformation?id={{$order->doctor->id}}">{{$order->doctor->user->name}}</a></td>
                <td>{{$order->appoint_date}}</td>
                <td><button class="btn btn-danger btn-sm" onclick="cancel_appointment(this)">取消预约</button></td>
            </tr>
        @endforeach
    </table>
@stop