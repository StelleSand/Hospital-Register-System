@extends("master")
@section("title","医院管理")
@section("script")
    <script>
        function add_office(){
            $("#messageModal").find(".modal-title").html("添加科室");
            var add_off_form=$('<form></form>').addClass("off_form").attr("id","add_office");
            $("#messageModal").find(".message-content").append(add_off_form);
            $(".off_form").append(getFormGroup("科室名称","name","text","请输入科室名称"));
            $(".off_form").append(getFormGroup("科室描述","description","textarea","请输入科室描述信息"));
            $("#messageModal").find("#button").html("确认添加");
        }
        function modal_btn_click(){

        }
    </script>
@stop
@section("extra")
    <div class="row">
        @foreach($offices as $office)
            <div class="col-md-4 center-block">
                <div class="panel panel-success">
                    <div class="panel-heading">科室名称</div>
                    <div class="panel-body">{{$office->name}}</div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading">科室描述</div>
                    <div class="panel-body">{{$office->descirption}}</div>
                </div>
                <br/>
                <button class="btn btn-primary">编辑该科室</button>
                &nbsp;
                <a href="#" class="btn btn-primary">添加医生</a>
                <br/>
            </div>
        @endforeach
    </div>
    <div class="row addOff_btn">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-right">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#messageModal" onclick="add_office()">添加一个科室</button>
        </div>
        <div class="col-md-2"></div>
    </div>
@stop