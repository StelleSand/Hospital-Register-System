@extends('master')
@section('title','首页')
@section('style')
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
<style>
        body{
            height: 100%;;
        }
        .header h1{
            font-family: 华文新魏;
        }
        #bs-example-navbar-collapse-1 li{
            padding-right: 50px;
        }
        .header-topic{
            background-color: #dddddd;
            height: 30px;
            text-align: center;
            line-height: 30px;
        }
</style>
@stop
@section('script')
<script>
$(function(){
var chosen_li=$(".nav-pills li");
console.log(chosen_li);
chosen_li.click(function(){
for(var i=0;i<chosen_li.length;i++){
$(chosen_li[i]).removeClass("active");
}
$(this).addClass("active");
})
})
</script>
@stop
@section('nav')
<nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">首页 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">挂号服务</a></li>
                        <li><a href="#">预约管理</a> </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">缴费管理 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">已缴费订单</a></li>
                                <li><a href="#">未缴费订单</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">登录</a></li>
                        <li><a href="#">注册</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
@stop
@section('content')
<div class="hospital-content">
<div class="header-topic">
            医院列表
        </div>
        <div>
            <ul class="nav nav-pills">
                <li role="presentation" class="active"><a href="#">北京市</a></li>
                <li role="presentation"><a href="#">朝阳区</a> </li>
                <li role="presentation"><a href="#">海淀区</a></li>
                <li role="presentation"><a href="#">丰台区</a></li>
                <li role="presentation"><a href="#">昌平区</a></li>
                <li role="presentation"><a href="#">大兴区</a></li>
            </ul>
        </div>
        <div class="hos_list">

        </div>
    </div>
@stop