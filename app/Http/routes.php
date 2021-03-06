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

// 初回画面
Route::get('/', 'WelcomeController@index');

// ユーザ登録
Route::get('signup', 'Auth\AuthController@getRegister')->name('signup.get');
Route::post('signup', 'Auth\AuthController@postRegister')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\AuthController@getLogin')->name('login.get');
Route::post('login', 'Auth\AuthController@postLogin')->name('login.post');
Route::get('logout', 'Auth\AuthController@getLogout')->name('logout.get');


Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', 'UsersController', ['only' => 'show']);
    Route::resource('circles', 'CirclesController');
    Route::resource('circle_payments', 'CirclePaymentsController');
    
    // circle_user
    Route::post('circle_user/request', 'CircleUserController@request')->name('circle_user.request');
    Route::delete('circle_user/cancel_request', 'CircleUserController@cancelRequest')->name('circle_user.cancel_request');
    Route::post('circle_user/accept_request', 'CircleUserController@acceptRequest')->name('circle_user.accept_request');
    Route::post('circle_user/reject_request', 'CircleUserController@rejectRequest')->name('circle_user.reject_request');
    Route::post('circle_user/leave', 'CircleUserController@leave')->name('circle_user.leave');

    // サークル関連
    Route::group(['prefix' => 'circles/{id}'], function () { 
        // ページ表示
        Route::get('graph', 'CirclesController@graph')->name('circles.graph');
        Route::get('list', 'CirclesController@input_list')->name('circles.list');
        Route::get('member', 'CirclesController@member')->name('circles.member');
    });
    
    
});