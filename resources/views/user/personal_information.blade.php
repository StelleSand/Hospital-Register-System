@extends("master")
@section("title","个人空间")
@section('script')
    <script>
        function edit_info(){
            $("#addFormModal").find(".modal-title").html("编辑信息");
            var name=$("#name").find(".panel-body").text();
            var phone=$("#phone").find(".panel-body").text();
            var description=$("#description").find(".panel-body").text();
            var form=$("<form></form>").attr('id','person_info').attr('data-id','edit');
            form.append(getFormGroupWithValue('姓名','name','text',name));
            form.append(getFormGroupWithValue('电话','phone','text',phone));
            form.append(getFormGroupWithValue('个人简介','description','textarea',description));
            showForm(form);
        }
        function modal_form_click(){
            $("#addFormModal").modal('hide');
            $("#addFormModal").one('hidden.bs.modal',function(e){
                //URL需重新写
                ajaxOneFormByID('person_info','editInfo',show_result);
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
                    if(result['type']=="edit")
                        show_person_info(result['user']['name'],result['user']['phone'],result['user']['description']);
                }
            }
        }
        function show_person_info(name,phone,description){
            $("#name").find(".panel-body").text(name);
            $("#phone").find(".panel-body").text(phone);
            $("#description").find(".panel-body").text(description);
        }
        function change_pwd(){
            $("#addFormModal").find(".modal-title").html("修改密码");
            var form=$("<form></form>").attr("id","person_info").attr('data-id','password');
            var alert_info=$("<span></span>").addClass("text-danger").attr("id","alert_info").attr("style","display:none").text("输入的密码不一致");
            form.append(getFormGroup("旧密码",'old_password','password','请输入旧密码'))
            form.append(getFormGroup("新密码",'password','password','请输入新密码'));
            var confirm=getFormGroup("确认密码",'confirm_password','password','请再输入一遍密码');
            confirm.children("input").attr("oninput","show_alert()").attr("onpropertychange","show_alert()");
            form.append(confirm.append(alert_info));
            showForm(form);
        }
        function show_alert(){
            var pwd=$("#change_pwd").find("input");
            if($(pwd[1]).val()!=$(pwd[2]).val()){
                $("#alert_info").show();
                $("#change_pwd").parents(".modal-body").next().children().attr("disabled","true");
            }
            else{
                $("#alert_info").hide();
                $("#change_pwd").parents(".modal-body").next().children().removeAttr("disabled");
            }
        }
    </script>
@stop
@section('extra')
    <div class="row">
        <div class="col-md-8" id="info_list">
            <div class="page-header"><h1>个人信息管理</h1></div>
            <div class="panel panel-default" id="name">
                <div class="panel-heading">
                    <h2 class="panel-title">姓名</h2>
                </div>
                <div class="panel-body">{{$user->name}}</div>
            </div>
            <div class="panel panel-success" id="email">
                <div class="panel-heading">
                    <h2 class="panel-title">邮箱</h2>
                </div>
                <div class="panel-body">{{$user->email}}</div>
            </div>
            <div class="panel panel-default" id="phone">
                <div class="panel-heading">
                    <h3 class="panel-title">联系电话</h3>
                </div>
                <div class="panel-body">{{$user->phone}}</div>
            </div>
            <div class="panel panel-success" id="description">
                <div class="panel-heading">
                    <h3 class="panel-title">个人简介</h3>
                </div>
                <div class="panel-body">{{$user->description}}</div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center"><button class="btn btn-primary btn-lg" onclick="edit_info()">编辑信息</button></div>
                <div class="col-md-6 text-center"><button class="btn btn-warning btn-lg" onclick="change_pwd()">修改密码</button></div>
            </div>
            <br><br><br>
        </div>
        <div class="col-md-4"></div>
    </div>
@stop