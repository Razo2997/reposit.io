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

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;

Route::get('/', 'MainController@redir')->name('redir');
Route::get('/welcome/{id?}', 'MainController@start')->name('start');
Route::get('/welcome/post/{id}', 'MainController@post_page')->name('post_page');

Route::group(['prefix'=>'admin','middleware'=>'admin'],function (){
    Route::get('/', function () {
        return view('admin.admin');
    });
    Route::get('/add-post','AdminController@post')->name('post');
    Route::post('/save-post','AdminController@add_post')->name('add_post');
    Route::post('/update-post','AdminController@update_post')->name('update_post');
    Route::get('/delete-post/{id}','AdminController@delete_post')->name('delete_post');
    Route::get('/edit-post/{id}','AdminController@edit_post')->name('edit_post');
    Route::get('/posts/{id?}','AdminController@all_posts')->name('all_posts');
    Route::get('/users/{id?}','AdminController@all_users')->name('all_users');
    Route::get('/set-status/{id?}','AdminController@set_status');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
