<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.css">
    <script type="text/javascript" src="./js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <title>Login</title>
    <style>
        .main-content{
            padding-top: 150px;
            width: 980px;
            padding-left: 400px;
        }
        .login-content {
            text-align: center;
            padding-bottom: 20px;
            font-size: large;
        }
        #button1{
            margin-left: 120px;
            width: 140px;
        }
        #button2{
            width: 140px;
            margin-left: 40px;
        }
        #button3{
            width: 180px;
            margin-left: 190px;
            margin-top: 20px;
        }

    </style>
</head>
<body>
<div>
    <div class="main-content">
        <div class="login-content">
            用户登录
        </div>
        <form action="login" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="exampleInputEmail1">Email：</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="邮箱地址">
        </div>
        <br/>
        <div class="form-group">
            <label for="exampleInputPassword1">密码：</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="密码">
        </div>
        <br/>
        <div>
            <button class="btn btn-default" id="button1" type="submit">登录</button>
            <button class="btn btn-default" id="button2" >忘记密码？</button>
        </div>
        <div class="register">
            <button class="btn btn-default" id="button3" type="submit">注册</button>
        </div>
        </form>
    </div>
</div>
</body>
</html>