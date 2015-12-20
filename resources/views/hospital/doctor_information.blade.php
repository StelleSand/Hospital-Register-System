@extends("master")
@section("title","医院挂号")
@section('style')
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-datetimepicker.css">
@stop
@section("script")
    <script type="text/javascript" src="./js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="./js/bootstrap-datetimepicker.zh-CN.js"></script>
    <script type="text/javascript" src="./js/make_appoint.js"></script>
@stop
@section("extra")
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <div><h1>医生信息</h1></div>
                <div class="form-group" id="doc_name" data-id="{{$doctor->id}}"><h2>{{$doctor->user->name}}</h2></div>
                <div class="form-group"><h3>级别：{{$doctor->level}}</h3></div>
                <div class="form-group"><h3>挂号费用：{{$doctor->price}}</h3></div>
                <div class="form-group"><h3>邮箱：{{$doctor->user>email}}</h3></div>
                <div class="form-group"><h3>联系电话：{{$doctor->user->phone}}</h3></div>
                <div class="form-group"><h3>介绍：{{$doctor->user->description}}</h3></div>
                <button class="btn btn-primary btn-lg center-block" onclick="make_appoint(this)">挂号</button>
            </div>
        </div>
    </div>
@stop
