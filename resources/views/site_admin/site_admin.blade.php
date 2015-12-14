@extends('master')
@section('title','网站管理')
@section('extra')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form class="form-horizontal" action="addHospital" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label>医院名称</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>医院简介</label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>具体地址</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>所在行政区</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>医院联系方式</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>医院管理员邮箱</label>
                    <input type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label>医院管理员用户名</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>医院管理员密码</label>
                    <input type="password" class="form-control">
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center">
                        <button class="btn btn-default" type="submit">添加医院</button>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </form>

        </div>
        <div class="col-md-2"></div>
    </div>
@stop