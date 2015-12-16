<!doctype html>
<html>
<head>
    <meta charset="utf-8">
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
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="/">首页 <span class="sr-only">(current)</span></a></li>
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

        @yield('extra')
        <div class="row">
            <div class="main_content col-md-12">
                @yield('content')
            </div>
        </div>
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
    <div class="collapse" id="coll_doctor">
        <div class="container" id="doc_show_list"></div>
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
