@extends("master")
@section("title","科室管理")
@section("script")
    <meta name="office" content={{$office->id}}>
    <script>
        function add_doctor(){
            $("#addFormModal").find(".modal-title").html("添加医生");
            var office_id=$("meta[name='office']").attr('content');
            var add_doc_form=$('<form></form>').addClass("doc_form").attr("id","add_doctor").attr('data-id',office_id);
            add_doc_form.append(getFormGroup('医生姓名','name','text','请输入医生姓名'));
            add_doc_form.append(getFormGroup('邮箱','email','email','请输入医生的邮箱'));
            add_doc_form.append(getFormGroup('密码','password','password','请输入密码'));
            add_doc_form.append(getFormGroup('医生级别','level','text','专家/普通医生'));
            add_doc_form.append(getFormGroup('挂号费用','price','number','请输入挂号费用'));
            $('#form-content').empty();
            $('#form-content').append(add_doc_form);
            var button=$("<button></button>").addClass("btn").addClass("btn-primary").attr("onclick","modal_form_click()").text("提交");
            $("#addFormModal").find(".modal-footer").empty().append(button);
            $('#addFormModal').modal('show');
        }
        function modal_form_click(){
            $("#addFormModal").modal('hide');
            $("#addFormModal").one('hidden.bs.modal',function(e){
                //URL需重新写
                ajaxOneFormByID('add_doctor','addDoctor',show_result);
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
                    show_doctor(result['doctor']['id'],result['doctor']['user']['name'],result['doctor']['user']['email'],result['doctor']['level'],result['doctor']['price']);
                }
            }
        }
        function show_doctor(id,name,email,level,price){
            var doc_list=$(".one_doctor");
            for(var i=0;i<doc_list.length;i++){
                if(id==$(doc_list[i]).find('.doc_name').attr('data-id')){
                    $(doc_list[i]).find('.doc_name').children().text(name);
                    $(doc_list[i]).find('.doc_level').children().text(level);
                    $(doc_list[i]).find('.doc_price').children().text(price);
                    return;
                }
            }
            var doc_id=$('<span></span>').text(id);
            var doc_name=$('<span></span>').text(name);
            var doc_email=$('<span></span>').text(email);
            var doc_level=$('<span></span>').text(level);
            var doc_price=$('<span></span>').text(price);
            var doc_panel_head=$('<div></div>').addClass('panel-heading').addClass('doc_name').attr('data-id',id).html('医生姓名：').append(doc_name);
            var doc_panel_body1=$('<div></div>').addClass('panel-body').addClass('doc_email').html("医生邮箱：").append(doc_email);
            var doc_panel_body2=$('<div></div>').addClass('panel-body').addClass('doc_level').html("医生级别：").append(doc_level);
            var doc_panel_body3=$('<div></div>').addClass('panel-body').addClass('doc_price').html("挂号费用：").append(doc_price);
            var doc_panel=$('<div></div>').addClass('panel').addClass('panel-success').append(doc_panel_head).append(doc_panel_body1).append(doc_panel_body2).append(doc_panel_body3);
            var doc_button=$('<button></button>').addClass('btn').addClass('btn-primary').attr('onclick','edit_doc(this)').text('编辑该医生');
            var btn=$('<div></div>').addClass('col-md-12').addClass('text-center').append(doc_button);
            var doc_main_body=$('<div></div>').addClass('col-md-4').addClass('one_doctor').append(doc_panel).append($('<div></div>').addClass('row').append(btn)).append('<br/>');
            $('#doctor_list').append(doc_main_body);
        }
        function edit_doc(btn){
            $("#addFormModal").find(".modal-title").html("编辑医生");
            var doc_name=$(btn).parents('.one_doctor').find('.doc_name').children('span').text();
            var doc_level=$(btn).parents('.one_doctor').find('.doc_level').children('span').text();
            var doc_price=$(btn).parents('.one_doctor').find('.doc_price').children('span').text();
            var doc_id=$(btn).parents('.one_doctor').find('.doc_name').attr('data-id');
            var add_doc_form=$('<form></form>').addClass("doc_form").attr("id","add_doctor").attr('data-id',doc_id);
            add_doc_form.append(getFormGroupWithValue('医生姓名','name','text',doc_name));
            add_doc_form.append(getFormGroupWithValue('医生级别','level','text',doc_level));
            add_doc_form.append(getFormGroupWithValue('挂号费用','price','number',doc_price));
            showForm(add_doc_form);
        }
        function delete_doc(btn){
            var doc_id=$(btn).parents('.one_doctor').find('.doc_name').attr('data-id');
            var err_message=$('<div></div>').addClass('alert').addClass('alert-warning').addClass('text-center').attr("data-id",doc_id).attr("id","alert_id");
            err_message.html("确定要删除该医生？");
            $('#form-content').empty();
            $('#form-content').append(err_message);
            var button1=$("<button></button>").addClass("btn").addClass("btn-danger").attr("onclick","confirm(this)").text("确定");
            var button2=$("<button></button>").addClass("btn").addClass("btn-primary").attr("onclick","cancel()").text("取消");
            $("#addFormModal").find(".modal-footer").empty().append(button1).append(button2);
            $('#addFormModal').modal('show');
        }
        function confirm(btn){
            var id=$("#alert_id").attr("data-id");
            var data={};
            data['id']=id;
            $("#addFormModal").modal('hide');
            $("#addFormModal").one('hidden.bs.modal',function(e){
                //URL需重新写
                ajaxData("deleteDoc",data,carry_result);
            })
        }
        //*********************************************
        function carry_result(data,status){
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
                    var doctor_list=$(".one_doctor");
                    for(var i=0;i<doctor_list.length;i++){
                        var doc_id=$(doctor_list[i]).find(".doc_name").attr("data-id");
                        if(result["id"]==doc_id){
                            $(doctor_list[i]).remove();
                            return;
                        }
                    }
                }
            }
        }
    </script>
@stop
@section("extra")
    <div class="row" id="doctor_list">
    @foreach($doctors as $doctor)
        <div class="col-md-4 one_doctor">
            <div class="panel panel-success">
                <div class="panel-heading doc_name" data-id="{{$doctor->id}}">医生姓名：<span>{{$doctor->user->name}}</span></div>
                <div class="panel-body doc_email">医生邮箱：<span>{{$doctor->user->email}}</span></div>
                <div class="panel-body doc_level">医生级别：<span>{{$doctor->level}}</span></div>
                <div class="panel-body doc_price">挂号费用：<span>{{$doctor->price}}</span></div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center"><button class="btn btn-primary" onclick="edit_doc(this)">编辑该医生</button></div>
                <div class="col-md-6 text-center"><button class="btn btn-danger" onclick="delete_doc(this)">删除该医生</button></div>
            </div>
            <br/>
        </div>
    @endforeach
    </div>
    <div class="row addDoc_btn">
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-primary btn-lg" onclick="add_doctor()">添加一个医生</button>
        </div>
    </div>
@stop