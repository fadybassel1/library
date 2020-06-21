<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create', 'BookController@create');


Route::resource('readers', 'ReaderController');


Route::get('/takepicture', function () {
    return view('reader.takepicture');
})->name('readers.takepicture');

Route::get('/attendance', function () {
    return view('reader.attendance');
})->name('attendance');


Route::post('/storess', 'ReaderController@attend')->name('storeattendance');
