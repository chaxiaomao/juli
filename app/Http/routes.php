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

Route::controllers(['user' => 'Auth\AuthController']);

Route::group(['prefix' => 'service', 'namespace' => 'Services'], function() {
    Route::get('validate_code/create', 'ValidateCodeController@create');
    Route::controllers(['cart' => 'CartController']);
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['namespace' => 'View\Home'], function () {
        Route::controller('home', 'indexController');
    });

});