<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//网站主要用户操作相关路由
Route::get('/','HospitalController@getAllHospital');
Route::get('home','HospitalController@getAllHospital');
Route::get('hospital','HospitalController@getAllOffices');
Route::get('doctorInformation','HospitalController@getDoctorInfo');
Route::post('submitOrder','HospitalController@ajaxSubmitOrder');

Route::get('/personinfo',function(){
   return view('user/personal_information');
});

Route::get('/home_page',function(){
    return view('home_page');
});

Route::get('/manage',function(){
    return view('user/manage_appointment');
});

Route::get('/triage',function(){
    return view('hospital_admin/hospital_triage');
});

//用户登录注册相关路由
Route::get('login', 'Auth\AuthController@getLogin');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');
Route::get('logout', 'Auth\AuthController@getLogout');

//管理员相关路由
Route::get('workSpace', ['middleware' => 'auth', 'uses' =>'UserController@getWorkSpace']);
Route::get('person', ['middleware' => 'auth', 'uses' =>'UserController@getPerson']);
Route::post('addHospital', ['middleware' => 'auth', 'uses' =>'UserController@postAddHospital']);
Route::post('addOffice', ['middleware' => 'auth', 'uses' =>'UserController@ajaxAddOffice']);
Route::get('addDoctor', ['middleware' => 'auth', 'uses' =>'UserController@getAddDoctor']);
Route::post('addDoctor', ['middleware' => 'auth', 'uses' =>'UserController@ajaxAddDoctor']);