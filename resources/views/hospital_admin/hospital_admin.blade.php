@extends("master")
@section("title","医院管理")
@section("script")
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
                <br/>
            </div>
        @endforeach
    </div>
    <div class="row addOff_btn">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-right">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#messageModal">添加一个科室</button>
        </div>
        <div class="col-md-2"></div>
    </div>
@stop