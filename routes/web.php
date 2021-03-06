<?php

use Illuminate\Support\Facades\Route;

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
    return view('guest.welcome');
});

Auth::routes();

Route::get('/posts', 'PostController@index')->name('posts.index');
Route::get('/posts/{post}', 'PostController@show')->name('posts.show');
Route::post('comments/{post}', 'CommentController@store')->name('comments.store');



Route::prefix('admin')->namespace('Admin')->name('admin.')->middleware('auth')->group(function()
{
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('comments/{post}', 'CommentController@store')->name('comments.store');
    Route::delete('comments/{post}', 'CommentController@destroy')->name('comments.destroy');
    Route::resource('posts', 'PostController');
});

