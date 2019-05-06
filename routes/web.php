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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/profile', 'UserController@index');
Route::post('/profile', 'UserController@update_avatar');

Route::resource('post', 'PostController');
Route::get('/search', 'PostController@search');

Route::resource('comment', 'CommentController');
