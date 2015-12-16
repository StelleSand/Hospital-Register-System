@extends("master")
@section("title","医院挂号")
@section("script")
    <script>
        $(function(){
            $('#messageModel').modal('hide');
            var data = <?php if(isset($offices)) echo json_encode($offices) ; else echo  'null'; ?>;
            function show_doctor(btn){
                var doc_id=$(btn).attr('data-id');
                var doc_to_show=getDoctorList(doc_id);
                showCollapse(doc_to_show);
            }
            function getDoctorList(id){
                var doc=getDocInfo(id);
                var doc_list=$('<div></div>').addClass('row');
                $.each(doc,function(i,val){
                    //URL需改
                    var doc_a=$('<a></a>').attr('href','URL?id='+val['id']).append($('<strong></strong>').text(val['name']));
                    var panel_head=$('<div></div>').addClass('panel-heading').addClass('doc_name').attr('data-id',val['id']).append(doc_a).append('&nbsp;&nbsp;&nbsp;&nbsp;').append($('<span></span>').text(val['level']));
                    var panel_body1=$('<div></div>').addClass('panel-body').addClass('label-success').attr('style','height:5em').text('介绍：').append($('<span></span>').text(val['description']));
                    var panel_body2=$('<div></div>').addClass('panel-body').addClass('text-right').append($('<button></button>').addClass('btn').addClass('btn-primary').attr('onclick','make_appoint(this)').text('挂号'));
                    var panel=$('<div></div>').addClass('panel').addClass('panel-success').append(panel_head).append(panel_body1).append(panel_body2);
                    var one_doc=$('<div></div>').addClass('col-md-3').addClass('one_doctor').append(panel).append('<br/>');
                    doc_list.append(one_doc)
                })
                return doc_list;
            }
            function getDocInfo(id){
                $.each(data,function(i,val){
                    if(val['id']==id){
                        return val['doctor'];
                    }
                })
            }
        })
    </script>
@stop
@section("extra")
    <div class="row">
        <div class="list-group col-md-12">
            @foreach($offices as $office)
                <button type="button" class="list-group-item" data-id="{{$office->id}}" onclick="show_doctor(this)">科室名称：{{$office->name}}</button>
            @endforeach
            <button type="button" class="list-group-item" data-id="12" onclick="show_doctor(this)">科室名称：妇科</button>
            <button type="button" class="list-group-item">Dapibus ac facilisis in</button>
            <button type="button" class="list-group-item">Morbi leo risus</button>
            <button type="button" class="list-group-item">Porta ac consectetur ac</button>
            <button type="button" class="list-group-item">Vestibulum at eros</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 one_doctor">
            <div class="panel panel-success">
                <div class="panel-heading doc_name" data-id="123"><a href="#"><strong>王医生</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;<span>主任医师</span></div>
                <div class="panel-body label-success" style="height: 5em">介绍：<span>就是很厉害就是很厉害就是很厉害就是很厉害就是很厉害就是很...</span></div>
                <div class="panel-body text-right"><button class="btn btn-primary" onclick="make_appoint(this)">挂号</button></div>
            </div>
            <div class="row"><div class="col-md-12 text-center"><button class="btn btn-primary" onclick="edit_doc(this)">挂号</button></div></div>
            <br/>
        </div>
        <div class="col-md-3 one_doctor">
            <div class="panel panel-success">
                <div class="panel-heading doc_name" data-id="123"><strong>王医生</strong>&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-right">主任医师</span></div>
                <div class="panel-body text-right label-success">挂号费用：<span>$1000000</span></div>
                <div class="panel-body text-right"><button class="btn btn-primary" onclick="edit_doc(this)">挂号</button></div>
            </div>
            <br/>
        </div>
        <div class="col-md-3 one_doctor">
            <div class="panel panel-success">
                <div class="panel-heading doc_name" data-id="123"><strong>王医生</strong>&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-right">主任医师</span></div>
                <div class="panel-body text-right label-success">挂号费用：<span>$1000000</span></div>
                <div class="panel-body text-right"><button class="btn btn-primary" onclick="edit_doc(this)">挂号</button></div>
            </div>
            <br/>
        </div>
        <div class="col-md-3 one_doctor">
            <div class="panel panel-success">
                <div class="panel-heading doc_name" data-id="123"><strong>王医生</strong>&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-right">主任医师</span></div>
                <div class="panel-body text-right label-success">挂号费用：<span>$1000000</span></div>
                <div class="panel-body text-right"><button class="btn btn-primary" onclick="edit_doc(this)">挂号</button></div>
            </div>
            <br/>
        </div>
        <div class="col-md-3 one_doctor">
            <div class="panel panel-success">
                <div class="panel-heading doc_name" data-id="123"><strong>王医生</strong>&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-right">主任医师</span></div>
                <div class="panel-body label-danger">介绍：<span>全国著名医师，牛逼的不得了啊</span></div>
                <div class="panel-body text-right"><button class="btn btn-primary" onclick="edit_doc(this)">挂号</button></div>
            </div>
            <br/>
        </div>
        <div class="col-md-3 one_doctor">
            <div class="panel panel-success">
                <div class="panel-heading doc_name" data-id="123"><strong>王医生</strong>&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-right">主任医师</span></div>
                <div class="panel-body text-right label-success">挂号费用：<span>$1000000</span></div>
                <div class="panel-body text-right"><button class="btn btn-primary" onclick="edit_doc(this)">挂号</button></div>
            </div>
            <br/>
        </div>
    </div>
@stop