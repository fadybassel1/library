<?php

Route::group(['namespace' => 'Reader'], function () {

    Route::get('/', 'HomeController@index')->name('reader.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('reader.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('reader.logout');
});
