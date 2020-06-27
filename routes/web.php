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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create', 'BookController@create');


Route::resource('readers', 'ReaderController');
Route::resource('books', 'BookController');
Route::get('bookSearch', 'BookController@bookSearch');


Route::get('/takepicture', function () {
    return view('reader.takepicture');
})->name('readers.takepicture');

Route::get('/attendance', function () {
    return view('reader.attendance');
})->name('attendance');



Route::get('/deletedreaders', 'ReaderController@deletedreaders')->name('deletedreaders');
Route::get('/deletedbooks', 'BookController@deletedbooks')->name('deletedbooks');
Route::get('/restoredeletedbook/{book}', 'BookController@restoredeleted')->name('restorebook');
Route::get('/restoredeletedreader/{reader}', 'ReaderController@restoredeleted')->name('restorereader');

Route::post('/storess', 'ReaderController@attend')->name('storeattendance');

Route::post('/storeimage', 'ReaderController@storeimage')->name('storeimage');
Route::get('/printcard/{id}', 'ReaderController@printcard')->name('printcard');
