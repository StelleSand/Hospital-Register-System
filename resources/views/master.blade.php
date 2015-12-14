<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.css">
    <script type="text/javascript" src="./js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <title>挂号服务-@yield('title')</title>
    <style>
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
            <div id="nav col-md-12">
            @yield('nav')
            </div>
        </div>
        <div class="row">
            <div class="main_content col-md-12">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
