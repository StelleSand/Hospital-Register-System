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
            @foreach($hospitals as $hospital)
                <div class="col-sm-3 col-md-3 hos">
                    <div class="thumbnail">
                        {{--<img src="{{$hospital->photo}}">--}}
                        <div class="caption">
                        <div class="hos_district">{{$hospital->district}}</div>
                            <h4 class="hos_name">{{$hospital->name}}</h4>
                            <p style="height: 4em;font-size: 10px" class="hos_description">{{$hospital->description}}</p>
                            <p><a href="hospital?id={{$hospital->id}}" class="btn btn-primary" role="button">进入医院挂号</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop