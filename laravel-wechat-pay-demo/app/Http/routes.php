<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function() {
    return view('index');
});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
 */

// common
Route::group(['middleware' => ['web']], function() {
    Route::post('pay/weixin/notify', 'WxpayController@notify');
});

// wechat
Route::group(['middleware' => ['web', 'wechat.oauth']], function() {
    Route::get('buy', 'BuyController@index');
});
