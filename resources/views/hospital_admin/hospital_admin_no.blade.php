@extends("master")
@section("title","医院管理")
@section("script")
    <script>
        function off_btn_click(){
            var addOffice=$(".addOffice");
            var off_len=addOffice.length;
            var off_form="<div class='row office'>"+$(addOffice[0]).children(".office").html()+"</div>";
            off_form+="<div class='row addDoctor'>"+$($(addOffice[0]).children(".addDoctor")[0]).html()+"</div>";
            off_form+="<div class='row addDoc_btn'>"+$(addOffice[0]).children(".addDoc_btn").html()+"<br/>"+"</div>";
            off_form+="<div class='row delOff_btn'>"+$(addOffice[0]).children(".delOff_btn").html()+"<br/>"+"</div>";
            off_form="<div class='row addOffice'>"+off_form+"<br/>"+"</div>";
            $(addOffice[off_len-1]).after(off_form);
        }
        function doc_btn_click(a){
            var addDoctor=$(a).parents(".addOffice").find(".addDoctor");
            var doc_len=addDoctor.length;
            var doc_form="<div class='row addDoctor'>"+$(addDoctor[0]).html()+"</div>";
            $(addDoctor[doc_len-1]).after(doc_form);
        }
        function del_off_click(a){
            $(a).parents(".addOffice").remove();
        }
        function del_doc_click(a){
            $(a).parents(".addDoctor").remove();
        }
        /*$(".off_btn").click(function(){
            var addOffice=$(".addOffice");
            var off_len=addOffice.length;
            var off_form="<div class='row office'>"+$(addOffice[0]).children(".office").html()+"</div>";
            off_form+="<div class='row addDoctor'>"+$($(addOffice[0]).children(".addDoctor")[0]).html()+"</div>";
            off_form+="<div class='row addDoc_btn'>"+$(addOffice[0]).children(".addDoc_btn").html()+"</div>";
            off_form="<div class='row addOffice'>"+off_form+"<br/>"+"</div>";
            $(addOffice[off_len-1]).after(off_form);
        })
        $(".doc_btn").click(function(){
            var addDoctor=$(this).parents(".addOffice").find(".addDoctor");
            var doc_len=addDoctor.length;
            var doc_form="<div class='row addDoctor'>"+$(addDoctor[0]).html()+"</div>";
            alert(doc_form);
            $(addDoctor[doc_len-1]).after(doc_form);
        })*/
    </script>
@stop
@section("extra")
    <div class="row addOffice">
        <div class="row office">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form>
                    <div class="form-group">
                        <label>科室名称</label>
                        <input type="text" class="form-control" name="office_name">
                    </div>
                    <div class="form-group">
                        <label>科室描述</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>

        <div class="row addDoctor">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <label>医生姓名</label>
                        <input type="text" class="form-control" name="doc_name">
                    </div>
                    <div class="form-group">
                        <label>密码</label>
                        <input type="password" class="form-control" name="doc_password">
                    </div>
                    <div class="form-group">
                        <label>医生级别</label>
                        <select class="form-control" name="doc_level">
                            <option selected>普通医生</option>
                            <option>专家</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>挂号费用</label>
                        <input type="text" class="form-control" name="doc_price">
                    </div>
                    <div class="form-group">
                        <label>医生描述</label>
                        <textarea class="form-control" name="doc_description"></textarea>
                    </div>
                </form>
                <div class="text-right">
                    <button class="btn btn-danger btn-sm del_doc_btn" onclick="del_doc_click(this)">删除该医生</button>
                </div>
                <br/>
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row addDoc_btn">
            <div class="col-md-3"></div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary btn-sm doc_btn" onclick="doc_btn_click(this)">在该科室添加一个医生</button>
            </div>
            <div class="col-md-3"></div>
        </div>
        <br/>

        <div class="row delOff_btn">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-right">
                <button class="btn btn-danger btn-lg del_off_btn" onclick="del_off_click(this)">删除该科室</button>
            </div>
            <div class="col-md-2"></div>
        </div>
        <br/>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-right">
            <button type="button" class="btn btn-primary btn-lg off_btn" onclick="off_btn_click()">添加一个科室</button>
        </div>
        <div class="col-md-2"></div>
    </div>








     @foreach($doctors as $doctor)
        <div class="col-md-4 one_doctor">
            <div class="panel panel-success">
                <div class="panel-heading doc_name" data-id="{{$doctor->id}}">医生姓名：<span>{{$doctor->name}}</span></div>
                <div class="panel-body doc_email">医生邮箱：<span>{{$doctor->email}}</span></div>
                <div class="panel-body doc_level">医生级别：<span>{{$doctor->level}}</span></div>
                <div class="panel-body doc_price">挂号费用：<span>{{$doctor->price}}</span></div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center"><button class="btn btn-primary" onclick="edit_doc(this)">编辑该医生</button></div>
            </div>
            <br/>
        </div>
     @endforeach
@stop