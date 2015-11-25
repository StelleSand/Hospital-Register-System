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
        .form-control{
            width: 150px;
        }
        .login_mini{
            border: solid 1px #245269;
            float: right;
            width: 200px;
        }
        .login-main{
                    padding-left: 15px;
                }
        .header-topic{
            background-color: #dddddd;
            height: 30px;
            text-align: center;
            line-height: 30px;
        }

        .btn-success{
            margin-left: 5px;
        }
        .hospital-content{
            width: 900px;
        }
        </style>
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
@section('onside')
<div class="login_mini">
        <div class="header-topic">用户登录</div>
        <div class="login-main">
            <label>账号</label>
            <input type="text" id="inputHelpBlock" class="form-control" aria-describedby="helpBlock">
            <span id="helpBlock" class="help-block">请输入用户名或手机号</span>
            <br/>
            <label>密码</label>
            <input type="password" class="form-control">
            <br/>
            <button type="submit" class="btn btn-success">登录</button>
            <button type="button" class="btn btn-warning">忘记密码？</button>
        </div>
        <hr/>
        </div>
@stop
@section('content')
<div class="hospital-content">
<div class="header-topic">
            医院列表
        </div>
        <div>
            <ul class="nav nav-pills">
                <li role="presentation" class="active"><a href="#">北京市</a></li>
                <li role="presentation"><a href="#">朝阳区</a></li>
                <li role="presentation"><a href="#">海淀区</a></li>
                <li role="presentation"><a href="#">丰台区</a></li>
                <li role="presentation"><a href="#">昌平区</a></li>
                <li role="presentation"><a href="#">大兴区</a></li>
            </ul>
        </div>
    </div>
@stop