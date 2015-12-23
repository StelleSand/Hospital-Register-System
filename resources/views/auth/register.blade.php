<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">
    <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="text-center">
                    <h2>用户注册</h2>
                </div>
                <form action="register" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="exampleInputPassword1">邮箱：</label>
                        <input required type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="请输入邮箱地址">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">用户名：</label>
                        <input required type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="请输入用户名">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">密码：</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="请输入密码">
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <button class="btn btn-default" id="buttons" type="submit">完成</button>
                        </div>
                        <div class="col-md-6 text-center">
                            <a class="btn btn-default" id="buttons" href="login">登录</a>
                        </div>
                    </div>
                </form>
            <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</body>
</html>
