@extends("master")
@section("title","历史订单")
@section("style")
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-datetimepicker.css">
@stop
@section("script")
    <script type="text/javascript" src="./js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="./js/bootstrap-datetimepicker.zh-CN.js"></script>
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

        var order_list=$(".order_list");
        $.each(order_list,function(i){
            if($(order_list[i]).children(".appoint_date").text()==$(order_list[i]).children(".appoint_date").attr("data-date"))
                if($(order_list[i]).children(".order_status").children("span").html()=="已付款可挂号")
                {
                    var button=$("<button></button>").addClass("btn").addClass("btn-primary").addClass("btn-sm").attr("onclick","triage_confirm(this)").text("打印预约单");
                    $(order_list[i]).children(".add_button").append(button);
                }
        })
        })
        function triage_confirm(btn){
            var id=$(btn).parent().parent().children(".order_id").attr("id");
            var user_name=$(btn).parent().parent().children(".user_name").text();
            var err_message=$('<div></div>').addClass('alert').addClass('alert-warning').addClass('text-center').attr("data-id",id).attr("id","alert_id");
            err_message.html("确认打印患者"+user_name+"预约单？");
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
                            $(order_list[i]).children(".order_status").children().text("分诊台已核实");
                            $(order_list[i]).children(".add_button").empty();
                        }
                    }
                }
            }
        }
        function change_input(value){
            $("#check_box").empty();
            if(value=="no")
                return;
            else{
                var label=$("<label></lable>");
                var input=$("<input>",{
                    type:"text"
                }).addClass("form-control");
                if(value=="office"){
                    label.text("请输入科室")
                    input.attr("name","office");
                }
                if(value=="doctor"){
                    label.text("请输入医生")
                    input.attr("name","doctor");
                }
                if(value=="id"){
                    label.text("请输入订单号")
                    input.attr("name","order_id");
                }
                if(value=="name"){
                    label.text("请输入用户姓名");
                    input.attr("name","user_name");
                }
                $("#check_box").append(label).append(input);
            }
        }
    </script>
@stop
@section("content")
    <div class="page-header"><h1>分诊台管理</h1></div>
        <form class="form-inline">
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="input2" class="control-label">请选择日期</label>
                    <div class="input-group date form_date" data-date data-date-format="yyyy年mm月dd日" data-link-field="input2" data-link-format="yyyy-m-d">
                        <input class="form-control" id="input1"  type="text" name="date_to_show" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" id="input2" name="date">
                </div>
                </div>
                <div class="col-md-6">
                    <label>请选择订单状态</label>
                    <select name="state" class="form-control">
                        <option value="">无限制</option>
                        <option value="payed">已付款可挂号</option>
                        <option value="triage_checked">分诊台已核实</option>
                        <option value="doctor_checked">就诊医生已核实</option>
                        <option value="completed">订单完成</option>
                        <option value="ordered">已预订未付款</option>
                        <option value="order_canceled">订单已取消</option>
                        <option value="payment_canceled">已退款</option>
                    </select>
                </div>
                <div class="col-md-6">
                <br/>
                <label for="select1">请选择筛选类型</label>
                <select name=sel onchange="change_input(this.options[this.options.selectedIndex].value)" class="form-control" id="select1">
                    <option value="no">请选择</option>
                    <option value="office">选择科室</option>
                    <option value="doctor">选择医生</option>
                    <option value="id">订单号</option>
                    <option value="name">预约人姓名</option>
                </select>
                </div>
                <div class="col-md-6">
                    <br/>
                    <div class="form-group" id="check_box"></div>
                </div>
            </div>
            <div class="row text-right"><button class="btn btn-primary" type="submit">查询</button></div>
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
                <tr class="order_list">
                    <td></td>
                    <td class="order_id" id="{{$order->id}}">{{$order->id}}</td>
                    <td class="user_name">{{$order->user->name}}</td>
                    <td>{{$order->doctor->office->name}}</td>
                    <td>{{$order->doctor->user->name}}</td>
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