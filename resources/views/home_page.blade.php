@extends("master")
@section("title","首页")
@section("script")

@stop
@section("extra")
    <div class="row">
        <div class="col-md-8">
            <div id="home_page_show" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#home_page_show" data-slide-to="0" class="active"></li>
                    <li data-target="#home_page_show" data-slide-to="1"></li>
                    <li data-target="#home_page_show" data-slide-to="2"></li>
                    <li data-target="#home_page_show" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="./image/web_1.jpg" alt="">
                        <div class="carousel-caption">
                        <!--可填入显示的文字内容-->
                        <h3 class="text-muted">北京市网上挂号预约挂号系统上线啦</h3>
                        </div>
                    </div>
                    <div class="item">
                        <img src="./image/web_2.jpg" alt="">
                        <div class="carousel-caption">
                        <!--可填入显示的文字内容-->
                        <h3 class="text-info">我们只为提供如此优质的医院</h3>
                        </div>
                    </div>
                    <div class="item">
                        <img src="./image/web_3.jpg" alt="">
                        <div class="carousel-caption">
                        <!--可填入显示的文字内容-->
                        <h3 class="text-muted">我们希望每一家人都健健康康</h3>
                        </div>
                    </div>
                    <div class="item">
                        <img src="./image/web_4.jpg" alt="">
                        <div class="carousel-caption">
                        <!--可填入显示的文字内容-->
                        <h3 class="text-muted">还在为预约挂号发愁吗</h3>
                        </div>
                    </div>
                </div>
                <a class="left carousel-control" href="#home_page_show" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#home_page_show" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <form class="form-inline text-right">
                <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" placeholder="快速查询医院">
                        </div>
                </div>
                <button class="btn btn-primary" type="submit">查询</button>
            </form>
            <br/>
            <p class="lead">用户使用说明</p>
            <p>1.<strong>挂号服务：</strong> 点击导航栏<strong>挂号服务</strong>按钮即可查看北京市内医院进行挂号，在医院主页点击科室会看到科室内医生，选择好时间即可进行预约。</p>
            <p>2.<strong>预约查询：</strong> 在系统挂号成功后，点击导航栏<strong>预约管理</strong>按钮，将可以查看到已经挂号并付款成功的订单（即预约），请在挂号日期前往就诊。</p>
            <p>3.<strong>查看历史订单：</strong>点击导航栏<strong>历史订单</strong>按钮即可查看自己所有已完成或者已取消的订单</p>
            <p>4.<strong>个人信息管理：</strong>在登录之后，点击导航栏右上角的<strong>用户名</strong>即可进入个人信息管理页面,用户可查看并修改个人信息。</p>
            <p><strong class="text-danger">注意：</strong><strong>邮箱</strong>是用户的唯一标识，一经绑定不可修改</p><br/>
            <div class="row">
                <div class="col-md-12 text-right"><a href="makeAppointment" class="btn btn-primary">去挂号吧</a></div>
            </div>
        </div>
    </div>
@stop