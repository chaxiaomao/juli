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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'wechat.oauth'], function () {
    Route::controllers(['user' => 'Auth\AuthController']);
    Route::group(['middleware' => 'auth'], function () {
        Route::group(['namespace' => 'View\Home'], function () {
            Route::controller('at/home', 'indexController');
        });
    });
});

Route::group(['namespace' => 'View\Admin'], function () {
    Route::controller('at/admin/user', 'userController');
    Route::controller('at/admin/order', 'orderController');
    Route::controller('at/admin/category', 'categoryController');
    Route::controller('at/admin/product', 'productController');
    Route::controller('at/admin', 'indexController');

});

Route::group(['prefix' => 'service', 'namespace' => 'Service'], function() {
    Route::get('validate_code/create', 'validateCodeController@create');
    Route::post('upload/{type}', 'uploadController@uploadFile');
    Route::any('wechat/oauth_callback', 'wechatCallbackController@oauthCallback');
    Route::any('wechat/pay_callback', 'wechatCallbackController@payCallback');
    Route::controllers(['cart' => 'cartController']);
    Route::controllers(['order' => 'orderController']);
    Route::controllers(['address' => 'addressController']);
    Route::controllers(['category' => 'categoryController', 'product' => 'productController']);
});
