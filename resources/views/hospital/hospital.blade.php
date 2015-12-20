@extends("master")
@section("title","医院挂号")
@section('style')
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-datetimepicker.css">
@stop
@section("script")
    <script type="text/javascript" src="./js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="./js/bootstrap-datetimepicker.zh-CN.js"></script>
    <script type="text/javascript" src="./js/make_appoint.js"></script>
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
            });
        })
        //点击科室展示该科室内所有医生实现函数
        /*
        function show_doctor(btn){
            $(btn).addClass('selectedBtn')
            var doc_id=$(btn).attr('data-id');
            var doc_to_show=getDoctorList(doc_id);
            showCollapse(btn,doc_to_show);
        }
        function showCollapse(bro,messageColl){
            $(bro).nextAll("#coll_doctor").remove();
            $(bro).prevAll("#coll_doctor").remove();
            $("btn").after(messageColl);
            $("#coll_doctor").collapse('toggle');
        }
        function getDoctorList(id){
            var doc=getDocInfo(id);
            var doc_coll=$('<div></div>').addClass('collapse').attr('id','coll_doctor');
            var doc_list=$('<div></div>').addClass('row');
            $.each(doc,function(i,val){
                //href的URL需改
                var doc_a=$('<a></a>').attr('href','URL?id='+val['id']).append($('<strong></strong>').text(val['name']));
                var panel_head=$('<div></div>').addClass('panel-heading').addClass('doc_name').attr('data-id',val['id']).append(doc_a).append('&nbsp;&nbsp;&nbsp;&nbsp;').append($('<span></span>').text(val['level']));
                var panel_body1=$('<div></div>').addClass('panel-body').addClass('label-success').attr('style','height:5em').text('介绍：').append($('<span></span>').text(val['description']));
                var panel_body2=$('<div></div>').addClass('panel-body').addClass('text-right').append($('<button></button>').addClass('btn').addClass('btn-primary').attr('onclick','make_appoint(this)').text('挂号'));
                var panel=$('<div></div>').addClass('panel').addClass('panel-success').append(panel_head).append(panel_body1).append(panel_body2);
                var one_doc=$('<div></div>').addClass('col-md-3').addClass('one_doctor').append(panel).append('<br/>');
                doc_list.append(one_doc);
            })
            doc_coll.append(doc_list);
            return doc_coll;
        }
        function getDocInfo(id){
            $.each(data,function(i,val){
                if(val['id']==id){
                    return val['doctor'];
                }
            })
        }
        */
    </script>
@stop
@section("extra")
    <div class="container-fluid">
        <div class="row">
            <div class="list-group col-md-12">
                @foreach($offices as $office)
                    <button type="button" class="list-group-item" data-id="{{$office->id}}" data-toggle="collapse" data-target="#office{{$office->id}}">科室名称：{{$office->name}}</button>
                    <div class="collapse" id="office{{$office->id}}">
                        <br/>
                        <div class="row">
                            @foreach($office->doctor as $doctor)
                                <div class="col-md-3 one_doctor">
                                    <div class="panel panel-success">
                                        <div class="panel-heading doc_name" data-id="{{$doctor->id}}">
                                            <div class="row">
                                                <div class="col-md-6 text-left"><a href="doctor_information?id={{$doctor->id}}"><strong>{{$doctor->user->name}}</strong></a></div>
                                                <div class="col-md-6 text-right">{{$doctor->level}}</div>
                                            </div>
                                        </div>
                                        <div class="panel-body label-success" style="height: 5em">介绍：<span>{{$doctor->description}}</span></div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-8 text-left" style="font-size: 10px;color: #122b40">挂号费用：{{$doctor->price}}</div>
                                                <div class="col-md-4 text-right"><button class="btn btn-primary" onclick="make_appoint(this)">挂号</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop