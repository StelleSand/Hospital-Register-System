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

Route::get('/','HospitalController@getAllHospital');
Route::get('/home','HospitalController@getAllHospital');

Route::get('/addHos',function(){
    return view('hospital_admin/hospital_admin');
});

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

Route::get('workSpace', ['middleware' => 'auth', 'uses' =>'UserController@getWorkSpace']);
Route::get('person', ['middleware' => 'auth', 'uses' =>'UserController@getPerson']);
Route::post('addHospital', ['middleware' => 'auth', 'uses' =>'UserController@postAddHospital']);