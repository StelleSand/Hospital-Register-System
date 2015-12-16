@extends("master")
@section("title","医院管理")
@section("script")
    <script>
        function add_office(){
            $("#addFormModal").find(".modal-title").html("添加科室");
            var add_off_form=$('<form></form>').addClass("off_form").attr("id","add_office");
            add_off_form.append(getFormGroup("科室名称","name","text","请输入科室名称"));
            add_off_form.append(getFormGroup("科室描述","description","textarea","请输入科室描述信息"));
            showForm(add_off_form);
        }
        function modal_form_click(btn){
            $("#addFormModal").modal('hide');
            //URL需要重新添加
            $("#addFormModal").one('hidden.bs.modal',function(event){    //hidden.bs.modal事件处理函数每次只执行一次
                ajaxOneFormByID('add_office','/office.php',show_result());
            })
        }
        function show_result(data,status){
            if(status!="success"){
                var err_message=$('<div></div>').addClass('alert').addClass('alert-warning').addClass('text-center');
                err_message.html("服务器请求失败");
                showMessage(err_message);
            }
            else{
                var result=data;
                if(result['status']=='error'){
                    var err_message=$('<div></div>').addClass('alert').addClass('alert-warning').addClass('text-center');
                    err_message.html(result['message']);
                    showMessage(err_message);
                }
                else{
                    var succ_message=$('<div></div>').addClass('alert').addClass('alert-success').addClass('text-center');
                    succ_message.html(result['message']);
                    showMessage(succ_message);
                    show_office(result['office']['id'],result['office']['name'],result['office']['description']);
                }
            }
        }
        function show_office(id,name,description){
            var off_name=$('<span></span>').text(name);
            var off_des=$('<span></span>').text(description);
            var off_panel_head=$('<div></div>').addClass('panel-heading').addClass('office_name').attr('data-id',id).html('科室名称：').append(off_name);
            var off_panel_body=$('<div></div>').addClass('panel-body').addClass('office_description').attr('style','height:4em').attr('data-info',description).html("科室描述：").append(off_des);
            var off_panel=$('<div></div>').addClass('panel').addClass('panel-success').append(off_panel_head).append(off_panel_body);
            var off_button=$('<button></button>').addClass('btn').addClass('btn-primary').attr('onclick','edit_off(this)').text('编辑该科室');
            var off_a=$('<a></a>').addClass('btn').addClass('btn-primary').attr('href','addDoctor?id='+id).text("添加医生");
            var btn1=$('<div></div>').addClass('col-md-6').addClass('text-center').append(off_button);
            var btn2=$('<div></div>').addClass('col-md-6').addClass('text-center').append(off_a);
            var off_main_body=$('<div></div>').addClass('col-md-4').addClass('one_office').append(off_panel).append($('<div></div>').addClass('row').append(btn1).append(btn2)).append('<br/>');
            $("#office_list").append(off_main_body);
        }
        function edit_off(btn){
            $("#addFormModal").find(".modal-title").html("添加科室");
            var off_name=$(btn).parents('.one_office').find('.office_name').children('span').text();
            var off_description=$(btn).parents('.one_office').find('.office_description').attr('data-info');
            var off_id=$(btn).parents('.one_office').find('.office_name').attr('data-id');
            var add_off_form=$('<form></form>').addClass("off_form").attr("id","add_office").attr('data-id',off_id);
            add_off_form.append(getFormGroupWithValue("科室名称","name","text",off_name));
            add_off_form.append(getFormGroupWithValue("科室描述","description","textarea",off_description));
            showForm(add_off_form);
        }
    </script>
@stop
@section("extra")
    <div class="row" id="office_list">
        @foreach($offices as $office)
            <div class="col-md-4 one_office">
                <div class="panel panel-success">
                    <div class="panel-heading office_name" data-id="{{$office->id}}">科室名称：<span>{{$office->name}}</span></div>
                    <div class="panel-body office_description" style="height: 4em" data-info="{{$office->description}}">科室描述：<span>{{$office->descirption}}</span></div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-center"><button class="btn btn-primary" onclick="edit_off(this)">编辑该科室</button></div>
                    <div class="col-md-6 text-center"><a href="addDoctor?id={{$office->id}}" class="btn btn-primary">添加医生</a></div>
                </div>
                <br/>
            </div>
        @endforeach
        <div class="col-md-4 one_office">
            <div class="panel panel-success">
                <div class="panel-heading office_name" data-id="1">科室名称：<span>妇科</span></div>
                <div style="height:4em" class="panel-body office_description" data-info="专治疑难杂症">科室描述：<span>专治疑难杂症</span></div>
            </div>
            <div class="row">
            <div class="col-md-6 text-center"><button class="btn btn-primary" onclick="edit_off(this)">编辑该科室</button></div>
            <div class="col-md-6 text-center"><a href="#" class="btn btn-primary">添加医生</a></div>
            </div>
            <br/>
        </div>
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">科室名称：妇科</div>
                <div style="height:4em" class="panel-body">科室描述：专治疑难杂症</div>
            </div>
            <div class="row">
            <div class="col-md-6 text-center"><button class="btn btn-primary">编辑该科室</button></div>
            <div class="col-md-6 text-center"><a href="#" class="btn btn-primary">添加医生</a></div>
            </div>
            <br/>
        </div>
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">科室名称：妇科</div>
                <div style="height:4em" class="panel-body">科室描述：专治疑难杂症</div>
            </div>
            <div class="row">
            <div class="col-md-6 text-center"><button class="btn btn-primary">编辑该科室</button></div>
            <div class="col-md-6 text-center"><a href="#" class="btn btn-primary">添加医生</a></div>
            </div>
            <br/>
        </div>
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">科室名称：妇科</div>
                <div style="height:4em" class="panel-body">科室描述：专治疑难杂症</div>
            </div>
            <div class="row">
            <div class="col-md-6 text-center"><button class="btn btn-primary">编辑该科室</button></div>
            <div class="col-md-6 text-center"><a href="#" class="btn btn-primary">添加医生</a></div>
            </div>
            <br/>
        </div>
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">科室名称：妇科</div>
                <div style="height:4em" class="panel-body">科室描述：专治疑难杂症</div>
            </div>
            <div class="row">
            <div class="col-md-6 text-center"><button class="btn btn-primary">编辑该科室</button></div>
            <div class="col-md-6 text-center"><a href="#" class="btn btn-primary">添加医生</a></div>
            </div>
            <br/>
        </div>
    </div>
    <div class="row addOff_btn">
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-primary btn-lg" onclick="add_office()">添加一个科室</button>
        </div>
    </div>
@stop