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
Route::resource('tags', 'TagController');
Route::get('bookSearch', 'BookController@bookSearch')->name('booksearch');
Route::get('bookSearch/{tagid}', 'BookController@bookTagSearch');


Route::get('/takepicture', function () {
    return view('reader.takepicture');
})->name('readers.takepicture')->middleware('auth');

Route::get('/attendance', function () {
    return view('reader.attendance');
})->name('attendance')->middleware('auth');





Route::get('/deletedreaders', 'ReaderController@deletedreaders')->name('deletedreaders');
Route::get('/deletedbooks', 'BookController@deletedbooks')->name('deletedbooks');
Route::get('/deletedusers', 'UserController@deletedusers')->name('deletedusers');
Route::get('/restoredeletedbook/{book}', 'BookController@restoredeleted')->name('restorebook');
Route::get('/restoredeletedreader/{reader}', 'ReaderController@restoredeleted')->name('restorereader');
Route::get('/restoredeleteduser/{user}', 'UserController@restoredeleted')->name('restoreuser');

Route::post('/storess', 'ReaderController@attend')->name('storeattendance');

Route::post('/storeimage', 'ReaderController@storeimage')->name('storeimage');
Route::get('/printcard/{id}', 'ReaderController@printcard')->name('printcard');

Route::post('/reportBook', 'BookController@report')->name('reportproblem');

Route::get('/deletereport/{id}', 'BookController@deletereport')->name('deletereport');
Route::get('/reports', 'BookController@showreports')->name('showreports');

Route::resource('users', 'UserController');
