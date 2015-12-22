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
        </div>
    </div>
@stop