<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="isloggedin"
    @if(!isset($user))
    content="no"
    @else
    content={{$user->id}}
    @endif
    >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.css">
    <script type="text/javascript" src="./js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/header.js"></script>
    <title>挂号服务-@yield('title')</title>
    <style>
        .header h1{
            font-family: 华文新魏;
        }
        .header{
            text-align: center;
        }
    </style>
    <script>
        $(function(){
            $("#nav_content").children('li').click(function(){
                $(this).prevAll().removeClass('active');
                $(this).nextAll().removeClass('active');
                $(this).addClass('active');
            })
        })
        function modal_mess_click(){
            $("#messageModal").modal('hide');
        }
    </script>
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
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#system_nav" aria-expanded="false">
                                  <span class="sr-only">适配小窗口</span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                              </button>
                              <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-plus"></span></a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="system_nav">
                            <ul class="nav navbar-nav" id="nav_content">
                                <li><a href="/">首页 <span class="sr-only">(current)</span></a></li>
                                <li><a href="#">挂号服务</a></li>
                                <li><a href="#">预约管理</a> </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">缴费管理 <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">已缴费订单</a></li>
                                        <li><a href="#">未缴费订单</a></li>
                                    </ul>
                                </li>
                                @if(isset($user))
                                @if($user->group!="user")
                                <li><a href="workSpace">工作空间</a></li>
                                @endif
                                @endif
                            </ul>
                            @if(!isset($user))
                                <ul class='nav navbar-nav navbar-right'>
                                    <li><a href='login'>登录</a></li>
                                    <li><a href='register'>注册</a></li>
                                </ul>
                            @else
                                <ul class='nav navbar-nav navbar-right'>
                                    <li><a href="person">Hello,&nbsp;{{$user->name}}</a></li>
                                    <li><a href='logout'>登出</a></li>
                                </ul>
                            @endif
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </div>


        <div class="row">
            <div class="main_content col-md-12">
                @yield('content')
            </div>
        </div>
        @yield('extra')
    </div>
    <div class="modal fade" id="addFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">提示信息</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div id="form-content" class="col-md-8">
                                {{--这是要放的消息主体--}}
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="form_button" data-id="addFormBtn" class="btn btn-primary" onclick="modal_form_click(this)">提交</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">提示信息</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div id="message-content" class="col-md-8">
                                    {{--这是要放的消息主体--}}
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="message_button" class="btn btn-primary" onclick="modal_mess_click()">知道了</button>
                    </div>
                </div>
            </div>
        </div>
<script>
    $(function(){
        $('#messageModel').modal('hide');
        var messages = <?php if(isset($messages)) echo json_encode($messages) ; else echo  'null'; ?>;
        showBackEndMessages(messages);
    })
</script>
</body>
</html>
