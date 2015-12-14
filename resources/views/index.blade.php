@extends('master')
@section('title','首页')
@section('style')
<style>
    #bs-example-navbar-collapse-1 li{
        padding-right: 50px;
    }
    .header-topic{
        background-color: #dddddd;
        height: 30px;
        text-align: center;
        line-height: 30px;
    }
</style>
@stop
@section('script')
<script>
    $(document).ready(function(){
        var hos=$(".hos");
        var hos_name=$(".hos_name");
        var hos_description=$(".hos_description");
        var hos_district=$(".hos_district");
        var chosen_li=$(".nav-pills li");
        $.each(hos,function(i){
            $(hos_district[i]).hide();
            var hos_name_text=$(hos_name[i]).text();
            var hos_description_text=$(hos_description[i]).text();
            if(hos_name_text.length>11){
                var max_hos_name=hos_name_text.substr(0,11)+"...";
                $(hos_name[i]).text(max_hos_name);
            }
            if(hos_description_text.length>56){
                var max_hos_description=hos_description_text.substr(0,56)+"...";
                $(hos_description[i]).text(max_hos_description);
            }
        })
        chosen_li.click(function(){
            for(var i=0;i<chosen_li.length;i++){
                $(chosen_li[i]).removeClass("active");
            }
            $(this).addClass("active");
            var hos_distr_val=$(this).children("a").text();
            for(var i=0;i<hos.length;i++){
                var hos_district_text=$(hos_district[i]).text();
                if(hos_distr_val=="北京市")
                    $(hos[i]).show();
                else if(hos_district_text==hos_distr_val)
                    $(hos[i]).show();
                else
                    $(hos[i]).hide();
            }
        })
    })
</script>
@stop
@section('nav')

@stop
@section('content')
<div class="hospital-content">
    <div class="header-topic">
            医院列表
        </div>
        <div>
            <ul class="nav nav-pills">
                <li role="presentation" class="active"><a href="#">北京市</a></li>
                <li role="presentation"><a href="#">朝阳区</a></li>
                <li role="presentation"><a href="#">海淀区</a></li>
                <li role="presentation"><a href="#">丰台区</a></li>
                <li role="presentation"><a href="#">昌平区</a></li>
                <li role="presentation"><a href="#">大兴区</a></li>
            </ul>
    </div>
    <div class="hos_list">
        <div class="row">
            @foreach($users as $user)
                <div class="col-sm-3 col-md-3 hos">
                    <div class="thumbnail">
                        <img src="{{$user->photo}}" alt="...">
                        <div class="caption">
                        <div class="hos_district">{{$user->district}}</div>
                            <h4 class="hos_name">{{$user->name}}</h4>
                            <p style="height: 4em;font-size: 10px" class="hos_description">{{$user->description}}</p>
                            <p><a href="#" class="btn btn-primary" role="button">进入医院挂号</a></p>
                        </div>
                    </div>
                </div>
            @endforeach


                <div class="col-sm-3 col-md-3 hos">
                    <div class="thumbnail">
                        <img src="..." alt="...">
                        <div class="caption">
                        <div class="hos_district">大兴区</div>
                            <h4 class="hos_name">11个字以上加...北航校医院北航校医院北航校医院北航校医院</h4>
                            <p style='height: 4em;font-size: 10px' class="hos_description">56字以上加...北航校医院北航校医院北航校医院北航校医院北航校医院北航校医院北航校医院北航校医院北航校医院北航校医院北航校医院北航校医院北航校医院</p>
                            <p class="text-center"><a href="#" class="btn btn-primary" role="button">进入医院挂号</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 hos">
                    <div class="thumbnail">
                        <img src="..." alt="...">
                        <div class="caption">
                            <div class="hos_district">昌平区</div>
                            <h4 class="hos_name">北航校医院北航校医院北北航校医院北航校医院...</h4>
                            <p style='height: 4em;font-size: 10px' class="hos_description">北航校医院北航校医院北航校医院北航校医院北航校医院北航校医院北航校医院北航校医院北航校医院北航校医院北航校医院北北航校医院北航校医院...</p>
                            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 hos">
                    <div class="thumbnail">
                        <img src="..." alt="...">
                        <div class="caption">
                        <div class="hos_district">海淀区</div>
                            <h4 class="hos_name">11个字以上加...</h4>
                            <p style="height: 4em;font-size: 10px" class="hos_description">...</p>
                            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 hos">
                    <div class="thumbnail">
                        <img src="..." alt="...">
                        <div class="caption">
                        <div class="hos_district">丰台区</div>
                            <h4 class="hos_name">Thumbnail label</h4>
                            <p style="height: 4em;font-size: 10px" class="hos_description">...</p>
                            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 hos">
                    <div class="thumbnail">
                        <img src="..." alt="...">
                        <div class="caption">
                        <div class="hos_district">朝阳区</div>
                            <h4 class="hos_name">Thumbnail label</h4>
                            <p style="height: 4em;font-size: 10px" class="hos_description">...</p>
                            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 hos">
                    <div class="thumbnail">
                        <img src="..." alt="...">
                        <div class="caption">
                        <div class="hos_district">朝阳区</div>
                            <h4 class="hos_name">Thumbnail label</h4>
                            <p style="height: 4em;font-size: 10px" class="hos_description">...</p>
                            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@stop