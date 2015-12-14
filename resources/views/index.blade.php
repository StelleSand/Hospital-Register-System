@extends('master')
@section('title','首页')
@section('style')
<style>
        body{
            height: 100%;;
        }
        .header h1{
            font-family: 华文新魏;
        }
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
$(function(){
var chosen_li=$(".nav-pills li");
console.log(chosen_li);
chosen_li.click(function(){
for(var i=0;i<chosen_li.length;i++){
$(chosen_li[i]).removeClass("active");
}
$(this).addClass("active");
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
                <li role="presentation"><a href="#">朝阳区</a> </li>
                <li role="presentation"><a href="#">海淀区</a></li>
                <li role="presentation"><a href="#">丰台区</a></li>
                <li role="presentation"><a href="#">昌平区</a></li>
                <li role="presentation"><a href="#">大兴区</a></li>
            </ul>
    </div>
    <div class="hos_list">
        <div class="row">
          <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
              <img src="..." alt="...">
              <div class="caption">
                <h3>Thumbnail label</h3>
                <p>...</p>
                <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@stop