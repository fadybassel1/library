<?php

Route::group(['namespace' => 'Reader'], function () {

    Route::get('/', 'HomeController@index')->name('reader.dashboard');

    // Login
   
   
    Route::group(['middleware' => ['guest:web','guest:reader']], function () {
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('reader.login');
        Route::post('login', 'Auth\LoginController@login');
    });
 
});
