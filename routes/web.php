<?php
Route::pattern('id','([0-9]*)');
Route::pattern('slug','(.*)');
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


Route::get('/', 'PageController@index');
Route::get('/about', 'PageController@about');
Route::get('/contact', 'PageController@contact');
Route::post('/contact', 'PageController@postContact');

Route::get('category/{slug}', 'PostController@category');
Route::get('post/{slug}', 'PostController@post');


/* ================== Login Admin ================== */
Route::get('admin/login', 'Auth\LoginController@login')->name('login');
Route::post('admin/login', 'Auth\LoginController@postLogin')->name('login');
Route::get('admin/logout', 'Auth\LoginController@logout');
/* ================== Login Admin ================== */

/* ================== Login Account ================== */
Route::get('login', 'PageController@login');
Route::post('login', 'PageController@postLogin');
Route::get('logout', 'PageController@logout');
Route::post('register', 'Auth\LoginController@postRegister');
Route::get('ajax/unique-email', 'Auth\LoginController@ajaxUniqueEmail');
