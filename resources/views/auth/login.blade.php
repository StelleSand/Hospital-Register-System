<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.css">
    <script type="text/javascript" src="./js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <title>Login</title>
</head>
<body>
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="text-center">
                    <h2>用户登录</h2>
                </div>
                <form action="login" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>Email：</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="邮箱地址">
                    </div>
                    <br/>
                    <div class="form-group">
                        <label>密码：</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="密码">
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <button class="btn btn-default" id="buttons" type="submit">登录</button>
                        </div>
                        <div class="col-md-4 text-center">
                            <a class="btn btn-default" id="buttons" >忘记密码？</a>
                        </div>
                        <div class="col-md-4 text-center">
                            <a class="btn btn-default" id="buttons" href="register">注册</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>
</body>
</html>