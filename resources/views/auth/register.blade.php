<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.css">
    <script type="text/javascript" src="./js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <title>Register</title>
    <style>
        .main-content{
            padding-top: 100px;
            width: 980px;
            padding-left: 400px;
        }
        .register-content{
            text-align: center;
            padding-bottom: 20px;
            font-size: large;
        }
        #button1{
            width: 180px;
            margin-left: 190px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        {{--<div class="main-content">--}}
            <div class="register-content">
                用户注册
            </div>
            <form action="register" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="exampleInputPassword1">邮箱：</label>
                <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="请输入邮箱地址">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">密码：</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="请输入密码">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-default" id="button1" type="submit">完成</button>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-default" href="login">登录</a>
                </div>
            </div>
            </form>
        {{--</div>--}}
    </div>
</body>
</html>
