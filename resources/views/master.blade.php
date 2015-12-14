<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.css">
    <script type="text/javascript" src="./js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <title>挂号服务-@yield('title')</title>
    <style>
        .header h1{
            font-family: 华文新魏;
        }
        .header{
            text-align: center;
        }
    </style>
    @yield('style')
    @yield('script')
</head>
<body>
    <div class="container">
        <div class="header row">
            <div class="col-md-12">
                @section('header')
                <h1>北京市网上预约挂号系统</h1>
                @show
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
                                <li><a href="workSpace">工作空间</a></li>
                            </ul>
                            @if(!isset($user))
                                <ul class='nav navbar-nav navbar-right'>
                                    <li><a href='login'>登录</a></li>
                                    <li><a href='register'>注册</a></li>
                                </ul>
                            @elseif($user->group=="user")
                                <ul class='nav navbar-nav navbar-right'>
                                    <li>Hello,&nbsp;{{$user->name}}</li>
                                    <li><a href='person'>个人中心</a></li>
                                </ul>
                            @elseif($user->group=="site_admin")
                                <ul class="nav navbar-nav navbar-right">
                                    <li>Hello,&nbsp;{{$user->name}}</li>
                                    <li><a href='person'>个人中心</a></li>
                                </ul>
                            @elseif($user->group="doctor")
                                <ul class="nav navbar-nav navbar-right">
                                    <li>Hello,&nbsp;{{$user->name}}</li>
                                    <li><a href='person'>个人中心</a></li>
                                </ul>
                            @elseif($user->group="hospital_admin")
                                <ul class="nav navbar-nav navbar-right">
                                    <li>Hello,&nbsp;{{$user->name}}</li>
                                    <li><a href='person'>个人中心</a></li>
                                </ul>
                            @endif
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </div>

        @yield('extra')
        <div class="row">
            <div class="main_content col-md-12">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
