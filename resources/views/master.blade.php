<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.css">
    <script type="text/javascript" src="./js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <title>挂号服务-@yield('title')</title>
    <style>
    #page-wrap{
                margin: 20px auto;
                padding: 3em;
                background: #fff;
                width: 1200px;
            }
            .header{
                        text-align: center;
                    }
    </style>
    @yield('style')
    @yield('script')
</head>
<body>
<div class="header">
@section('header')
<h1>北京市网上预约挂号系统</h1>
@show
</div>
<div id="page-wrap">
<div id="nav">
@yield('nav')
</div>
@yield('onside')
<div class="main_content">
@yield('content')
</div>
</div>
</body>
</html>
